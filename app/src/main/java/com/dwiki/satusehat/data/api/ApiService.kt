package com.dwiki.satusehat.data.api

import com.dwiki.satusehat.data.responseModel.*
import com.dwiki.satusehat.model.PasienLogin
import com.dwiki.satusehat.model.PasienSignUp
import retrofit2.Response
import retrofit2.http.*

interface ApiService {

    @GET("rumahsakit")
    suspend fun getRumahSakit():Response<RumahSakit>

    //login
    @FormUrlEncoded
    @POST("login")
    suspend fun login(
        @Field("nik") nik:String,
        @Field("password") password: String
    ):Response<PasienLoginResponse>

    //register
    @FormUrlEncoded
    @POST("signup")
    suspend fun signup(
        @Field("nik") name:String,
        @Field("nama") nama:String,
        @Field("jenis_kelamin") jenis_kelamin: String,
        @Field("tanggal_lahir") tanggal_lahir:String,
        @Field("agama") agama:String,
        @Field("pekerjaan") pekerjaan:String,
        @Field("pendidikan") pendidikan:String,
        @Field("status_perkawinan") status_perkawinan:String,
        @Field("no_bpjs") no_bpjs:String,
        @Field("no_hp") no_hp:String,
        @Field("password") password:String
    ):Response<PasienRegisterResponse>

    //get profile pasien
    @GET("pasien")
    suspend fun getProfilePasien(
        @Header("Authorization") token:String
    ):Response<PasienProfileResponse>

    //get Status Antren Pasien
    @GET("antreanlive")
    suspend fun getStatusAntreanPasien(
        @Header("Authorization") token:String
    ):Response<StatusAntreanResponse>


}