<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UktPrediction extends Model {
  protected $fillable = ['student_id','cluster','tier','vector'];
  protected $casts = ['vector' => 'array'];
  public function student(){ return $this->belongsTo(Student::class); }
}