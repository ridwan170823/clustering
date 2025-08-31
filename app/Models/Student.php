<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
  protected $fillable = ['nama','nim','pendapatan','pekerjaan_ortu','tanggungan','kepemilikan_rumah','status_ortu'];
  public function predictions(){ return $this->hasMany(UktPrediction::class); }
}