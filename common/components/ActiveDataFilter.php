<?php

namespace common\components;

use yii\helpers\Json;

class ActiveDataFilter extends \yii\data\ActiveDataFilter
{

    public function load($data, $formName = null) {
        if (array_key_exists($this->filterAttributeName, $data)) {
            $filterValue = $data[$this->filterAttributeName];
            try {
                $filterValue = Json::decode($filterValue);
                if (is_array($filterValue))
                    $data[$this->filterAttributeName] = $filterValue;
            } catch (\InvalidArgumentException $e) {

            }
        }

        return parent::load($data, $formName);
    }

}