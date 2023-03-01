<?php

namespace App\Modules\Employee\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    protected $attributes = [
        'nik'                => null,
        'nama'               => null,
        'nickname'           => null,
        'gender'             => null,
        'alamat'             => null,
        'kota'               => null,
        'kodepos'            => null,
        'telpon'             => null,
        'handphone'          => null,
        'pob'                => null,
        'dob'                => null,
        'agama'              => null,
        'joindate'           => null,
        'lasteducation'      => null,
        'edu_school'         => null,
        'is_married'         => null,
        'nama_istri'         => null,
        'dob_istri'          => null,
        'tgl_menikah'        => null,
        'is_permanent'       => null,
        'is_active'          => null,
        'phkdate'            => null,
        'phkreason'          => null,
        'id_golongan'        => null,
        'id_dept'            => null,
        'id_jabatan'         => null,
        'kd_struktur'        => null,
        'alamat_asal'        => null,
        'kota_asal'          => null,
        'kodepos_asal'       => null,
        'iso_9002'           => null,
        'iso_14001'          => null,
        'is_shift'           => null,
        'contract_start'     => null,
        'contract_end'       => null,
        'id_div'             => null,
        'id_sec'             => null,
        'id_subsec'          => null,
        'status_pajak'       => null,
        'contract_start2'    => null,
        'contract_end2'      => null,
        'ttl_month1'         => null,
        'ttl_month2'         => null,
        'warga_negara'       => null,
        'mata_uang'          => null,
        'ukuran_baju'        => null,
        'ukuran_sepatu'      => null,
        'gol_darah'          => null,
        'kel_dekat'          => null,
        'kel_phone'          => null,
        'bus'                => null,
        'employeeno'         => null,
        'nilai'              => null,
        'kel_wanita'         => null,
        'kopkar'             => null,
        'gajipokok'          => null,
        'kurs'               => null,
        'union_fspmi'        => null,
        'union_internal'     => null,
        'account_no'         => null,
        'tunj_keahlian'      => null,
        'a_technical'        => null,
        'a_tempat_kerja'     => null,
        'npwp'               => null,
        'tgl_jabatan'        => null,
        'tgl_tetap'          => null,
        'no_ktp'             => null,
        'sts_bpjs1'          => null,
        'no_kk'              => null,
        'ibu_kandung'        => null,
        'status_kel'         => null,
        'sts_bpjstk'         => null,
        'sts_bpjspensiun'    => null,
        'kd_plant'           => null,
        'ket_kontrak'        => null,
        'ukuran_celana'      => null,
        'ukuran_baju_lengan' => null,
        'reff_rekrutmen'     => null,
        'kd_grade'           => null,
        'provinsi'           => null,
        'provinsi_asal'      => null,
        'kepemilikan_rumah'  => null,
        'outsource_tgl'      => null,
        'asuransi_nama'      => null,
        'asuransi_plan'      => null,
        'bpjstk_tglgabung'   => null,
        'bpjstk_nopeserta'   => null,
        'bpjskes_tglgabung'  => null,
        'bpjskes_nopeserta'  => null,
        'kpj_tglgabung'      => null,
        'kpj_nopeserta'      => null,
        'bank_nama'          => null,
        'badan_tinggi'       => null,
        'badan_berat'        => null,
        'notes'              => null,
        'loker_no'           => null,
        'loker_no_kunci'     => null,
        'npwp_exp'           => null,
        'dept_jpn'           => null,
        'area_kerja'         => null,
        'empid_text'         => null,
        'kd_grup_shift'      => null,
        'remark'             => null,
    ];

    // protected $datamap = [
    //     // property_name => db_column_name
    //     'name' => 'full_name',
    // ];

    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }
    }

    public function __set($key, $value)
    {
        if (property_exists($this, $key)) {
            $this->{$key} = $value;
        }
    }
}
