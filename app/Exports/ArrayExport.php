<?php

namespace App\Exports;

use Illuminate\Contracts\Collections\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArrayExport implements FromCollection, WithHeadings
{
    protected Collection $rows;
    protected array $headings;

    public function __construct(Collection $rows, array $headings)
    {
        $this->rows = $rows;
        $this->headings = $headings;
    }

    public function collection(): Collection
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
