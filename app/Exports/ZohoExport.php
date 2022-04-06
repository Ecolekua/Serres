<?php

namespace App\Exports;

use App\zoho;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ZohoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Mandante',
            'Id',
            'Razón Social Mandante',
            'Rut Mandante',
            'Obra',
            'Razón Social Contratista',
            'Rut Contratista',
            'Período CCOLP',
            'Periodo a CCOLP Mes',
            'N° de Trabajadores a Certificar',
            'N° Contrato o Servicio Prestado Informa Contratista',
            'Contacto Nombre',
            'Contacto Tel.',
            'Contacto Email',
            'Estado Certificación',
            'Fecha Recepción',
            'Fecha Emisión',
            'Ejecutivo Asignado',
            'N° Certificado',
            'N° Factura',
            'Pagado Si/No',
            'Días Hábiles',
            'Observación',
            //  'Control Documental Trabajadores',
            //  'Control Documental Empresa',
            //  'Evaluación Financiera',
            //  'Otros Documentos',
            'Tipo de Solicitud',
            'Tipo de Documento',
            'Observación',
            'cantidad_reenvios',
            'updated_at',
        ];
    }


    public function collection()
    {
        return zoho::all();
    }
}
