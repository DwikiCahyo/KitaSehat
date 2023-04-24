package com.dwiki.satusehat.data.api

import com.dwiki.satusehat.data.responseModel.*
import retrofit2.Response

interface ApiHelper {

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

    suspend fun getProfilePasien(
        token:String
    ):Response<PasienProfileResponse>
}