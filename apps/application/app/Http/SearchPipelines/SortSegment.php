<?php

namespace App\Http\SearchPipelines;

class SortSegment extends BaseSearchPipelines
{
    protected function applyFilter($builder, $param)
    {
        //check for relationship
        $columnMap = explode('.', $param);
        $sortDirection = request('sortDirection', 'desc');

        if (count($columnMap) <= 1) {
            return $builder->orderBy($param, $sortDirection);
        }
        $mainModel = $builder->getModel();
        $mainModalName = $mainModel::class;
        $mainTableName = $mainModel->getTable();
        switch ($columnMap[0]) {
            case 'address':
                return $builder
                    ->leftJoin('addresses', function ($join) use ($mainTableName, $mainModalName) {
                        $join->on("$mainTableName.id", 'addresses.addressable_id')
                            ->where('addresses.addressable_type', $mainModalName)
                            ->whereNull('addresses.deleted_at');
                    })
                    ->orderBy("addresses.{$columnMap[1]}", $sortDirection);
                break;

            case 'member':
                $column = 'name' === $columnMap[1] ? 'last_name' : $columnMap[1];

                return $builder
                    ->join('members', 'requests.member_id', '=', 'members.id')
                    ->select('requests.*')
                    ->orderBy("members.{$column}", $sortDirection);
                break;

            case 'payer':
                $column = 'company_name' === $columnMap[1] ? 'name' : $columnMap[1];

                return $builder
                    ->join('payers', $mainTableName.'.payer_id', '=', 'payers.id')
                    ->select($mainTableName.'.*')
                    ->orderBy("payers.{$column}", $sortDirection);
                break;

            case 'user':
                $column = 'name' === $columnMap[1] ? 'last_name' : $columnMap[1];

                return $builder
                    ->join('users', $mainTableName.'.member_id', '=', 'members.id')
                    ->select($mainTableName.'.*')
                    ->orderBy("members.{$column}", $sortDirection);
                break;

            default:
                return $builder;
                break;
        }

        return $builder->orderBy($param, $sortDirection);
    }
}
