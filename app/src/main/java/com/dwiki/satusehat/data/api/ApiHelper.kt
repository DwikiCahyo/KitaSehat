package com.dwiki.satusehat.data.api

import com.dwiki.satusehat.data.responseModel.GetRumahSakitItem
import com.dwiki.satusehat.data.responseModel.PasienLoginResponse
import com.dwiki.satusehat.data.responseModel.PasienRegisterResponse
import com.dwiki.satusehat.data.responseModel.RumahSakit
import retrofit2.Response

interface ApiHelper {

    suspend fun getRumahSakit():Response<RumahSakit>
    suspend fun getLoginResult(nik:String,password:String):Response<PasienLoginResponse>
    suspend fun getResgisterResult(
        nik: String,
        password: String,
        nama:String,
        agama:String,
        dob:String,
        jenisKelamin:String,
        pekerjaan:String,
        pendidikan:String,
        statusPerkawinan:String,
        noBpjs:String,
        noHpString: String
    ):Response<PasienRegisterResponse>
}