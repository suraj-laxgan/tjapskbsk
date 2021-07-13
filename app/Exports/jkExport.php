<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Admin\JhApplicant;

class jkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mem_id = request('mem_id');
      $application_no = request('application_no');
      $mem_nm = request('mem_nm');
      $post_applied_for = request('post_applied_for');
      $mem_email = request('mem_email');

          $query  = JhApplicant::query();
          $all_applicant = '';
          if($application_no != '')
          {
            $query = $query->where('application_no', 'like', '%' . $application_no . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($post_applied_for != '')
          {
            $query = $query->where('post_applied_for', 'like', '%' . $post_applied_for . '%');
          }
          if($mem_id != '')
          {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
          }
          $query = $query->get();
          return $query;
    }

    public function headings(): array
    {
        return ["First Name", "Last Name", "Mobile","DOB", "Gender"];
        // return array_keys($this->collection()->first()->toArray());
    }
}
