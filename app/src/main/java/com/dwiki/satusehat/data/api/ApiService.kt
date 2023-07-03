package com.dwiki.satusehat.data.api


import com.dwiki.satusehat.model.responseModel.*
import okhttp3.MultipartBody
import retrofit2.Response
import retrofit2.http.*

interface ApiService {

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
        @Header("Authorization") token:String,
    ):Response<StatusAntreanResponse>

    @GET("rumahsakit")
    suspend fun getRumahSakit(
        @Header("Authorization") token:String,

    ):Response<RumahSakitResponse>

    @GET("fasilitasrumahsakit")
    suspend fun getFasilitasRumahSakit(
        @Header("Authorization") token:String,
        @Query("rumah_sakit_id") rumah_sakit_id:String
    ):Response<FasilitasRumahSakitResponse>

    @FormUrlEncoded
    @POST("{jenisAntrean}")
    suspend fun postRegistrasiAntrean(
        @Path("jenisAntrean") jenisAntrean:String,
        @Header("Authorization") token:String,
        @Field("fasilitas_rumah_sakit_id") fasilitas_rumah_sakit_id:String,
        @Field("keluhan_awal") keluhan_awal:String,
    ):Response<RegistrasiAntreanResponse>

    @GET("riwayatantreanbpjs")
    suspend fun getRiwayatAntrean(
        @Header("Authorization") token:String,
    ):Response<RiwayatPendaftaranResponse>

    @GET("riwayatantreanumum")
    suspend fun getRiwayatAntreanUmum(
        @Header("Authorization") token: String
    ):Response<RiwayatPendaftaranUmumResponse>

    @GET("antreanbpjs")
    suspend fun getDetailRiwayatBpjs(
        @Header("Authorization") token: String,
        @Query("id") id:Int
    ):Response<DetailRiwayatResponse>

    @GET("antreanumum")
    suspend fun getDetailRiwayatUmum(
        @Header("Authorization") token: String,
        @Query("id") id:Int
    ):Response<DetailRiwayatResponse>

    @FormUrlEncoded
    @POST("rumahsakit")
    suspend fun getDetailRumahSakit(
        @Header("Authorization") token: String,
        @Field("rumah_sakit_id") rumah_sakit_id:Int
    ):Response<DetailRumahSakitResponse>

    @GET("antreanlive")
    suspend fun getAntreanLive(
        @Header("Authorization") token: String,
    ):Response<AntreanLiveResponse>


    @FormUrlEncoded
    @PUT("pasien")
    suspend fun editProfile(
        @Header("Authorization") token: String,
        @Field("nama") nama:String,
        @Field("jenis_kelamin") jenis_kelamin: String,
        @Field("tanggal_lahir") tanggal_lahir:String,
        @Field("agama") agama:String,
        @Field("pekerjaan") pekerjaan:String,
        @Field("pendidikan") pendidikan:String,
        @Field("status_perkawinan") status_perkawinan:String,
        @Field("no_bpjs") no_bpjs:String,
        @Field("no_hp") no_hp:String,
    ):Response<ProfileItemResponse>


    @Multipart
    @POST("fotopasien")
    suspend fun uploadImage(
        @Header("Authorization") token: String,
        @Part file: MultipartBody.Part
    ):Response<EditFotoProfileResponse>

    @GET("kontakdarurat")
    suspend fun getKontakDarurat(
        @Header("Authorization") token: String,
    ):Response<KontakDaruratResponse>

    @FormUrlEncoded
    @POST("kontakdarurat")
    suspend fun postKontakDarurat(
        @Header("Authorization") token: String,
        @Field("nama") nama:String,
        @Field("no_hp") no_hp:String
    ):Response<EditFotoProfileResponse>

    @FormUrlEncoded
    @POST("cancelantrean")
    suspend fun cancelAntrean(
        @Header("Authorization") token: String,
        @Field("jenis_pasien") jenis_pasien:String,
        @Field("antrean_id") antrean_id:Int
    ):Response<BatalkanAntreanResponse>






}