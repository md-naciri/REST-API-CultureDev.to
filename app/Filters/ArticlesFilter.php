<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ArticlesFilter extends ApiFilter{

        protected $safeParms = [
                'title' => ['eq'],
                'description' => ['eq'],
                'content' => ['eq'],
                'userId' => ['eq','gt','lt'],
                'categoryId' => ['eq','gt','lt'],
                'tagId' => ['eq','gt','lt']
                 
        ];
    
     protected $columnMap = [
                'userId' => 'user_id',
                'categoryId' => 'category_id',
                'tagId' => 'tag_id'
        ];
    
     protected $operatorMap = [
                'eq' => '=',
                'lt' => '<',
                'lte' => '<=',
                'gt' => '>',
                'gte' => '>=',
        ];
    
    
}