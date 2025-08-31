<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use JsonException;

class UktKMeans {
  private array $encoders;
  private array $featureCols;
  private array $mean;
  private array $scale;
  private array $centroids; // standardized
  private array $clusterToTier;

  public function __construct(?string $path = null) {
    // Lokasi utama (disk local = storage/app atau app/private tergantung konfigurasi)
    $candidates = array_filter([
      $path,                                   // kalau kamu kirim manual
      'ukt_kmeans_artifacts.json',             // storage/app (atau app/private di projectmu)
      'public/ukt_kmeans_artifacts.json',      // storage/app/public
    ]);

    $raw = null; $used = null;

    foreach ($candidates as $cand) {
      if (Storage::disk('local')->exists($cand)) {
        $raw  = Storage::disk('local')->get($cand);
        $used = Storage::disk('local')->path($cand);
        break;
      }
      // fallback: disk public
      if (Storage::disk('public')->exists($cand)) {
        $raw  = Storage::disk('public')->get($cand);
        $used = Storage::disk('public')->path($cand);
        break;
      }
    }

    if ($raw === null) {
      throw new \RuntimeException(
        "Artifacts JSON tidak ditemukan. Coba taruh di storage/app (atau storage/app/private) " .
        "dengan nama 'ukt_kmeans_artifacts.json'."
      );
    }

    try {
      $json = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
      throw new \RuntimeException("Gagal parse JSON artifacts (lokasi: {$used}). Pesan: ".$e->getMessage());
    }

    foreach (['encoders','feature_cols','scaler_mean','scaler_scale','centroids_standardized','cluster_to_tier'] as $k) {
      if (!array_key_exists($k, $json)) {
        throw new \RuntimeException("Key '{$k}' hilang di artifacts JSON (lokasi: {$used}).");
      }
    }

    $this->encoders      = $json['encoders'];
    $this->featureCols   = $json['feature_cols'];
    $this->mean          = $json['scaler_mean'];
    $this->scale         = $json['scaler_scale'];
    $this->centroids     = $json['centroids_standardized'];
    $this->clusterToTier = $json['cluster_to_tier'];
  }

  /** @param array $payload string persis seperti opsi kuesioner */
  public function predict(array $payload): array {
    // 1) encode ordinal
    $encoded = [];
    foreach ($this->featureCols as $col) {
      $val = $payload[$col] ?? null;
      $map = $this->encoders[$col] ?? [];
      if (!array_key_exists($val, $map)) {
        throw new \InvalidArgumentException("Nilai tidak dikenali untuk {$col}: {$val}");
      }
      $encoded[] = $map[$val];
    }

    // 2) standardize
    $std = [];
    foreach ($encoded as $i => $v) {
      $den = ($this->scale[$i] ?: 1e-9);
      $std[] = ($v - $this->mean[$i]) / $den;
    }

    // 3) nearest centroid (Euclidean)
    $bestIdx = -1; $bestDist = INF;
    foreach ($this->centroids as $ci => $c) {
      $sum = 0.0;
      foreach ($c as $j => $cj) {
        $d = $std[$j] - $cj; $sum += $d * $d;
      }
      $dist = sqrt($sum);
      if ($dist < $bestDist) { $bestDist = $dist; $bestIdx = (int)$ci; }
    }

    $tier = $this->clusterToTier[(string)$bestIdx] ?? $this->clusterToTier[$bestIdx] ?? 'UKT ?';

    return [
      'cluster'  => $bestIdx,
      'tier'     => $tier,
      'vector'   => $std,
      'distance' => $bestDist,
    ];
  }

  public function options(): array {
    return $this->encoders; // untuk dropdown form
  }
}
