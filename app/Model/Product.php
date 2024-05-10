<?php

App::uses('AppModel','Model');

class Product extends AppModel{
    public $validate = array(
        'name' => array(
            'rule' => 'notBlank',
            'message' => 'Product name cannot be blank'
        ),
        'price' => array(
            'rule' => 'numeric',
            'message' => 'Please enter numeric value'
        )
        );
}