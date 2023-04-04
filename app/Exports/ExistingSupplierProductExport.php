<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExistingSupplierProductExport implements WithHeadings, FromCollection, WithStyles
{
    public $supplierId;

    public function __construct($supplierId) {
        $this->supplierId = $supplierId;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setVisible(false);
        $sheet->getColumnDimension('C')->setVisible(false);
    }

    /**
     * tamplate headings
     */
    public function headings(): array
    {
        return [
            'supplier_id',
            'supplier_name',
            'product_id',
            'product_name',
            'product_code',
            'price'
        ];
    }

    public function collection()
    {
        $suppliers = SupplierProduct::where('suplier_id','=',$this->supplierId)->get();

        $sId = Supplier::where('id','=',$this->supplierId)->first();

        $arr = [];

        for ($i=0; $i < count($suppliers); $i++) { 
            $newArr = [];

            $product = Product::where('id', '=', $suppliers[$i]->product_id)->first();

            

            $newArr = [$sId->id, $sId->name, $product->id, $product->product_name, $suppliers[$i]->suplier_product_code, $suppliers[$i]->product_price];

            array_push($arr, $newArr);
        }

        return new Collection($arr);
    }
}
