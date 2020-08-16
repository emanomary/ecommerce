<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = "vendors";
    protected $fillable = [
        'name',
        'logo',
        'mobile',
        'email',
        'address',
        'main_category_id',
        'active',
        'created_at',
        'updated_at' ];

    protected $hidden = ['main_category_id'];

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

    //handle active attribute
    public function getActive()
    {
        return $this->active == 1? 'مفعل':'غير مفعل';
    }

    //handle photo
    public function getLogoAttribute($val)
    {
        return ($val != null) ? asset('assets/'.$val) : '';
    }

    public function scopeSelection($query)
    {
        return $query->select('id',
            'name',
            'logo',
            'mobile',
            'main_category_id',
            'active');
    }

    public function maincategory()
    {
        return $this->belongsTo('App/Models/MainCategory','id ');
    }
}
