<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [
        "eq" => "=",
        "lt" => "<",
        "lte" => "<=",
        "gt" => ">",
        "gte" => ">="
    ];
    
    public function transform(Request $request): array
    {
        $eloQuery = [];
        foreach(
            $this->safeParams as $param => $operators
        ) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }
            // dd($query, $param);
            $column = $this->columnMap[$param] ?? $param;

            foreach($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [
                        $column, 
                        $this->operatorMap[$operator],
                        $query[$operator]
                    ];
                }
            }
        }
        return $eloQuery;
    }
}