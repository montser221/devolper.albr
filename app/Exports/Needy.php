<?php
namespace App\Exports;
use App\Models\Dulni;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use \Carbon\Carbon;
class Needy implements   FromQuery, WithMapping ,WithHeadings
{
		use Exportable;

	public function query()
    {
        $query = Dulni::query();

		if($query->count() == null)
		{
		    return die('<div class="alert alert-danger">عفوا لاتوجد بيانات </div>');
			// throw new \Exception('error');
		}
		if($query->count() > 0)
		{
			return  $query;
		}
    }

    //headings
     public function headings(): array
    {
        return [
            'الاسم',
            'الهاتف',
            'العنوان',
            'المحتاج',
            'التفاصيل',
            'تاريخ التقديم',
        ];
    }

     public function map($needy): array
    {
        return [
            $needy->name,
            $needy->phone,
            $needy->address,
            $needy->needy,
            $needy->details,
            $needy->created_at->format('Y-m-d'),
        ];
    }
}
