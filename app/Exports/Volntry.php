<?php
namespace App\Exports;
use App\Models\Voluntary;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use \Carbon\Carbon;
class Volntry implements   FromQuery, WithMapping ,WithHeadings
{
		use Exportable;

	public function query()
    {
        $query = Voluntary::query();

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
            'إسم الاب',
            'إسم الجد',
            '  الاسم الاخير',
            'الحالة الاجتماعية',
            '  رقم الهوية',
            'الجنسية',
            'وقت التواصل المفضل',
            'الايمل',
            'النوع',
            'تاريخ الميلاد',
            'الوظيفة',
            'جهة العمل',
            'العنوان',
            'الهاتف  ',
            'تاريخ التقديم',
        ];
    }
/*
 'firstName','fatherName','grandFatherName','lastName',
      'socialState','ssnNumber','natonality','bestContactTime','email','gender',
      'birthDate','jobTitle','jobEmployer','address','phone' */
     public function map($needy): array
    {
        $gender ='';
        if($needy->gender=="male")
        {
            $gender="ذكر";
        }
        else if($needy->gender=="female")
        {
            
            $gender = "أنثى";
        }
        else
        {
            $gender = 'غير معروف';
        }
        $socialState ="";
        if($needy->socialState=="married")
        {
            $socialState="متزوج";
        }
        else if($needy->socialState=="unmarried")
        {
            
            $socialState = "أعزب";
        }
        else
        {
            $socialState = 'غير معروف';
        }
        return [
            $needy->firstName,
            $needy->fatherName,
            $needy->grandFatherName,
            $needy->lastName,
            $socialState,
            $needy->ssnNumber,
            $needy->natonality,
            $needy->bestContactTime,
            $needy->email,
            $gender,
            $needy->birthDate,
            $needy->jobTitle,
            $needy->jobEmployer,
            $needy->address,
            $needy->phone,
            $needy->created_at->format('Y-m-d'),
        ];
    }
}
