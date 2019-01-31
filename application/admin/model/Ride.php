<?php

namespace app\admin\model;

use think\Model;

class Ride extends Model
{
    // 表名
    protected $name = 'ride_sharing';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    
    // 追加属性
    protected $append = [
        'starting_time_text',
        'status_text',
        'type_text'
    ];
    

    
    public function getStatusList()
    {
        return ['normal' => __('Normal'),'hidden' => __('Hidden')];
    }     

    public function getTypeList()
    {
        return ['passenger' => __('Passenger'),'driver' => __('Driver')];
    }     


    public function getStartingTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['starting_time']) ? $data['starting_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getTypeTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setStartingTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
