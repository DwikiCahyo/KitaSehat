package com.dwiki.satusehat.data.repository

import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.liveData
import com.dwiki.satusehat.data.api.ApiHelper
import com.dwiki.satusehat.data.api.ApiService
import com.dwiki.satusehat.data.responseModel.*
import com.dwiki.satusehat.util.Resources
import kotlinx.coroutines.delay
import kotlinx.coroutines.flow.Flow
import kotlinx.coroutines.flow.flow
import javax.inject.Inject

class MainRepository @Inject constructor(private val apiHelper: ApiHelper, private val apiService: ApiService) {
    suspend fun getRegisterResult(
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
    ) = apiHelper.getResgisterResult(nik,nama,jenisKelamin,ttl,agama,pekerjaan,pendidikan,statusPerkawinan,noBpjs,noHP,password)

    //get profile pasien
    suspend fun getProfile(token: String) =  apiHelper.getProfilePasien(token)


    fun loginResult(nik: String,password: String):LiveData<Resources<PasienLoginResponse>> = liveData {
        emit(Resources.loading(null))
        try {
            val response = apiService.login(nik,password)
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"success : ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"Error : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error : ${e.cause.toString()}")
        }
    }



    //Profile Pasien
    fun getProfilePasien(token:String):LiveData<Resources<PasienProfileResponse>> = liveData {
        emit(Resources.loading(null))
        try {
            val response = apiService.getProfilePasien("Bearer $token")
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes profile : ${response.message()}")
            } else{
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error Profile get data : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Profile : ${e.cause.toString()}")
        }
    }

    //Status Antrean
    fun getStatusAntreanRepository(token:String):LiveData<Resources<StatusAntreanResponse>> = liveData {
        emit(Resources.loading(null))
        delay(1000L)
        try {
            val response = apiService.getStatusAntreanPasien("Bearer $token")
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes status antrean : ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error Status Antrean : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status Antrean : ${e.cause.toString()}")
        }
    }

    //get list rumah sakit
    fun getRumahSakit(token: String):Flow<Resources<RumahSakitResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.getRumahSakit("Bearer $token")
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes rumah sakit : ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error rumah sakit : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status rumah sakit : ${e.cause.toString()}")
        }
    }

    fun getFasilitasRumahSakit(token: String, idRumahSakit: String):Flow<Resources<FasilitasRumahSakitResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.getFasilitasRumahSakit("Bearer $token",idRumahSakit)
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes fasilitas rumah sakit: ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error fasilitas rumah sakit : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status fasilitas rumah sakit : ${e.cause.toString()}")
        }
    }

    fun postRegistrasiPasien(jenisAntrean:String,token: String,idFasilitas:String,keluhan:String):Flow<Resources<RegistrasiAntreanResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.postRegistrasiAntrean(jenisAntrean,"Bearer $token",idFasilitas,keluhan)
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes registrasi antrean: ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error registrasi antreean : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status registrasi antrean : ${e.cause.toString()}")
        }
    }

    fun getRiwayatPendaftaran(token:String):Flow<Resources<RiwayatPendaftaranResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.getRiwayatAntrean("Bearer $token")
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes riwayat antrean bpjs: ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error riwayat antrean bpjs : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status riwayat antrean bpjs : ${e.cause.toString()}")
        }

    }

    fun getRiwayatPendaftaranUmum(token:String):Flow<Resources<RiwayatPendaftaranUmumResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.getRiwayatAntreanUmum("Bearer $token")
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes riwayat antrean umum: ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error riwayat antrean umum: ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status riwayat antrean umum : ${e.cause.toString()}")
        }

    }

    fun getDetailRiwayatBpjs(token: String,idRiwayat:Int):Flow<Resources<DetailRiwayatResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.getDetailRiwayatBpjs("Bearer $token",idRiwayat)
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes detail riwayat bpjs: ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error detail riwayat bpjs : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status riwayat antrean bpjs : ${e.cause.toString()}")
        }
    }

    fun getDetailRiwayatUmum(token: String,idRiwayat: Int):Flow<Resources<DetailRiwayatResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.getDetailRiwayatUmum("Bearer $token",idRiwayat)
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes detail riwayat umum: ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error detail riwayat umum : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status riwayat antrean umum : ${e.cause.toString()}")
        }
    }

    fun getDetailRumahSakit(token:String,idRumahSakit:Int):Flow<Resources<DetailRumahSakitResponse>> = flow {
        emit(Resources.loading(null))
        try {
            val response = apiService.getDetailRumahSakit("Bearer $token",idRumahSakit)
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes detail rumah sakit: ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error detail rumah sakit: ${response.errorBody()?.string()}")
            }
        }catch(e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error Status detail rumah sakit : ${e.cause.toString()}")
        }
    }


    companion object {
        private const val TAG = "Repository"
    }

}