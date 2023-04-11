package com.dwiki.satusehat.data.api

import com.dwiki.satusehat.data.responseModel.GetRumahSakitItem
import com.dwiki.satusehat.data.responseModel.PasienLoginResponse
import com.dwiki.satusehat.data.responseModel.PasienRegisterResponse
import com.dwiki.satusehat.data.responseModel.RumahSakit
import com.dwiki.satusehat.model.PasienLogin
import com.dwiki.satusehat.model.PasienSignUp
import retrofit2.Response
import javax.inject.Inject

class ApiHelperImpl @Inject constructor(private val apiService: ApiService): ApiHelper {

    override suspend fun getRumahSakit(): Response<RumahSakit> = apiService.getRumahSakit()

    override suspend fun getLoginResult(
        nik: String,
        password: String
    ): Response<PasienLoginResponse> {
        return apiService.login(nik, password)
    }

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


}