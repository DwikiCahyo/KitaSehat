package com.dwiki.satusehat.data.repository

import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.liveData
import com.dwiki.satusehat.data.api.ApiHelper
import com.dwiki.satusehat.data.api.ApiService
import com.dwiki.satusehat.data.responseModel.PasienLoginResponse
import com.dwiki.satusehat.data.responseModel.PasienProfileResponse
import com.dwiki.satusehat.model.PasienLogin
import com.dwiki.satusehat.util.Resources
import kotlinx.coroutines.delay
import java.util.SimpleTimeZone
import javax.inject.Inject

class MainRepository @Inject constructor(private val apiHelper: ApiHelper, private val apiService: ApiService) {
    suspend fun getRumahSakit() = apiHelper.getRumahSakit()
    suspend fun getLoginResul(nik:String,pass:String) = apiHelper.getLoginResult(nik,pass)
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

    fun loginResult(nik: String,password: String):LiveData<Resources<PasienLoginResponse>> = liveData {
        emit(Resources.loading(null))
        try {
            val response = apiService.login(nik,password)
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes : ${response.message()}")
            } else {
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error : ${e.message.toString()}")
        }
    }


    fun getProfilePasien(token:String):LiveData<Resources<PasienProfileResponse>> = liveData {
        emit(Resources.loading(null))
        try {
            val response = apiService.getProfilePasien("Bearer $token")
            if (response.isSuccessful){
                emit(Resources.success(response.body()))
                Log.d(TAG,"succes : ${response.message()}")
            } else{
                emit(Resources.error(response.errorBody()?.string(),null))
                Log.e(TAG,"error : ${response.errorBody()?.string()}")
            }
        } catch (e:Exception){
            emit(Resources.error(e.message.toString(),null))
            Log.e(TAG,"error : ${e.message.toString()}")
        }
    }


    companion object {
        private const val TAG = "Repository"
    }

}