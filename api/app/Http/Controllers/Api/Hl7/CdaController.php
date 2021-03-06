<?php

namespace App\Http\Controllers\Api\Hl7;

use App\Http\Controllers\Controller;
use App\Models\Diagnosi;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CdaController extends Controller
{
    //  instalacion
    // sudo apt-get install php-xml
    public function show(int $id)
    {
       try {

            $fecha_actual = new \DateTime('NOW');
            $fecha_actual = $fecha_actual->format('Y-m-d');

            $code = Str::random(4);
            $ConfidiatityCode = Str::random(7);

            $patient = Patient::find($id);
            $m_r = $patient->medical_record;
            $antecedentes = $patient->antecedentes;
            $consultas = $m_r->medical_consultations;

            $diseases = [];
            $tratamientos = [];

                foreach ($consultas as $consulta) {
                    foreach ($consulta->diagnosis as $data) {
                        foreach ($data->diseases as $dise) {
                            $push['name'] = $dise->name;
                            $push['description'] = $dise->description;
                            $diseases[] = $push;
                        }
                        foreach ($data->diseases as $value) {
                            foreach ($value->medical_treatments as $medicamentos) {
                                $pushtratament['medicine'] = $medicamentos->medicine;
                                $pushtratament['description'] = $medicamentos->description;
                                $tratamientos[] = $pushtratament;
                            }
                       }
                    }
                }


            $xml = new \XMLWriter();
            $xml->openMemory();
            $xml->setIndent(true);
            $xml->setIndentString('');
            $xml->startDocument('1.0', 'UTF-8');

            $xml->startElement("clinicalDocument");//documento clinico

                $xml->startElement("Header"); // header
                    $xml->writeElement('id',$m_r->id);
                    $xml->writeElement('Code', $code);
                    $xml->writeElement('ConfidiatityCode', $ConfidiatityCode);
                    $xml->writeElement('fecha', $fecha_actual);
                $xml->endElement();// fin header

                $xml->startElement("component"); // componente padre
                    $xml->startElement("structureBody"); // estuctura del body

                       $xml->startElement("section"); // section 1
                            $xml->startElement("component"); // primer componente dentro del section 1

                                $xml->startElement("patient"); // datos del paciente
                                    $xml->writeElement('name',$patient->first_name);
                                    $xml->writeElement('apellido', $patient->last_name);
                                    $xml->writeElement('Genero', $patient->sex);
                                    $xml->writeElement('telefono', $patient->phone);
                                    $xml->writeElement('cedula', $patient->ci);
                                    $xml->writeElement('estado_civil', $patient->civil_status);
                                    $xml->writeElement('fecha_nacimiento', $patient->birthdate);
                                    $xml->writeElement('peso', $patient->weight);
                                $xml->endElement();  //fin del paciente

                            $xml->endElement();// fin primer componente dentro del section 1
                       $xml->endElement();// fin section 1

                        $xml->startElement("section"); // section 2
                            $xml->startElement("component"); // primer componente dentro del section 2
                                $xml->startElement("Registro"); // datos del registro
                                $xml->writeElement('fecha_de_regsitro',$patient->created_at);
                                $xml->writeElement('Ciudad', 'San Juan De Los Morros');
                                $xml->writeElement('Municipio', 'Juan German Roscio');
                                $xml->writeElement('Nombre','Centro de Diagnostico Integral Tulio Pineda');
                                $xml->endElement();  //fin datos del registro
                            $xml->endElement();// fin primer componente dentro del section 2
                        $xml->endElement();// fin section 2

                        $xml->startElement("section"); // section 3
                            $xml->startElement("component"); // primer componente dentro del section 3
                                $xml->startElement("Patologias"); // datos de las patologias
                                foreach ($diseases as $patologia) {
                                    $xml->writeElement('patologia',$patologia['name']);
                                    $xml->writeElement('descripcion',$patologia['description']);
                                }
                                $xml->endElement();  //fin datos de las patologias
                            $xml->endElement();// fin primer componente dentro del section 3
                        $xml->endElement();// fin section 3

                        $xml->startElement("section");// section 4
                            $xml->startElement("component");// primer componente dentro del section 2
                                $xml->startElement("Antecedentes");// datos del registro
                                foreach ($antecedentes as $antecedente) {
                                    $xml->writeElement('antecedente',$antecedente['name']);
                                    $xml->writeElement('description', $antecedente['description']);
                                }
                                $xml->endElement();//fin datos del registro
                            $xml->endElement();// fin primer componente dentro del section 2
                        $xml->endElement();// fin section 4

                        $xml->startElement("section"); // section 5
                            $xml->startElement("component"); // primer componente dentro del section 4
                                $xml->startElement("Medicamentos"); // datos de los medicamentos
                                foreach ($tratamientos as $medicamento) {
                                    $xml->writeElement('medicamento',$medicamento['medicine']);
                                    $xml->writeElement('description',$medicamento['description']);
                                }
                                $xml->endElement();  //fin datos de los medicamentos
                            $xml->endElement();// fin primer componente dentro del section 4
                        $xml->endElement();// fin section 5


                    $xml->endElement();// fin estuctura del body
                $xml->endElement();// fin componente padre


            $xml->endElement(); //fin clinical documento

            $content = $xml->outputMemory();
            ob_end_clean();
            ob_start();
            header('Content-Type: application/xml; charset=UTF-8');
            header('Content-Encoding: UTF-8');
            header("Content-Disposition: attachment;filename=ejemplo.xml");
            header('Expires: 0');
            header('Pragma: cache');
            header('Cache-Control: private');

            return  $content;

       } catch (Exception $e) {

           return $e;

       }

    }

    public function pdfImport($id)
    {
        try {

            $fecha_actual = new \DateTime('NOW');
            $fecha_actual = $fecha_actual->format('Y-m-d');
            $patient = Patient::find($id);

            $m_r = $patient->medical_record;
            $antecedentes = $patient->antecedentes;
            $consultas = $m_r->medical_consultations;

            $diseases = [];

            $tratamientos = [];

                foreach ($consultas as $consulta) {
                    foreach ($consulta->diagnosis as $data) {
                        foreach ($data->diseases as $dise) {
                            $push['name'] = $dise->name;
                            $push['description'] = $dise->description;
                            $diseases[] = $push;
                        }
                        foreach ($data->diseases as $value) {
                            foreach ($value->medical_treatments as $medicamentos) {
                                $pushtratament['medicine'] = $medicamentos->medicine;
                                $pushtratament['description'] = $medicamentos->description;
                                $tratamientos[] = $pushtratament;
                            }
                       }
                    }
                }

                $pdf = PDF::loadView('pdf/HistoryClinical', [
                                                                'fecha' => $fecha_actual,
                                                                'patient' => $patient,
                                                                'diseases'=> $diseases,
                                                                'tratamientos' => $tratamientos,
                                                                'antecedentes' => $antecedentes,
                                                            ]
                                    );

                return $pdf->download('CI:'.$patient->ci.'.pdf');


        } catch (Exception $e) {
            return $e;
        }
    }
}
