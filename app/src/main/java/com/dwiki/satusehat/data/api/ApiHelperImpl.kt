package com.dwiki.satusehat.data.api

import com.dwiki.satusehat.model.PasienLogin
import com.dwiki.satusehat.model.PasienSignUp
import com.dwiki.satusehat.model.responseModel.PasienProfileResponse
import com.dwiki.satusehat.model.responseModel.PasienRegisterResponse
import retrofit2.Response
import javax.inject.Inject

class ApiHelperImpl @Inject constructor(private val apiService: ApiService): ApiHelper {


    override suspend fun getResgisterResult(
         nik:String,
         nama:String,
         jenisKelamin:String,
         ttl:String,
         agama:String,
         pekerjaan: String,
         pendidikan: String,
         statusPerkawinan: String,
         noBpjs: String,
         noHP: String,
         password: String
    ): Response<PasienRegisterResponse> {
        return apiService.signup(nik, nama, jenisKelamin, ttl, agama, pekerjaan, pendidikan, statusPerkawinan, noBpjs, noHP, password)
    }

    override suspend fun getProfilePasien(token: String): Response<PasienProfileResponse> {
        return apiService.getProfilePasien(token)
    }


}