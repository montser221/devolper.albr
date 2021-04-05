<?php
namespace App\Exports;
use App\Models\ContactUs;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use \Carbon\Carbon;
class Contact implements   FromQuery, WithMapping ,WithHeadings
{
		use Exportable;

	public function query()
    {
        $query = ContactUs::query();

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
            'البريد الالكتروني',
            'الهاتف  ',
            'الموضوع',
            'الرسالة',
            'نوع الرسالة',
            'التاريخ',
        ];
    }
    
     public function map($contact): array
    {
        $message ='غير محدد';
        if($contact->msgType=="complaint")
        {
            $message="شكوى";
        }
        else if($contact->message=="suggist")
        {
            
            $message = "إقتراح";
        }
        else
        {
            $message = 'إستفسار';
        }
         
        return [
            $contact->fullname,
            $contact->email,
            $contact->phone,
            $contact->topic,
            $contact->message,
            $message,
            $contact->created_at->format('Y-m-d'),
        ];
    }
}
