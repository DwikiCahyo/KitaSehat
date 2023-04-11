package com.dwiki.satusehat.viewModel

import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.data.responseModel.PasienRegisterResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class RegisterViewModel @Inject constructor(private val mainRepository: MainRepository):ViewModel() {

    private val _registerResult = MutableLiveData<Resources<PasienRegisterResponse>>()
    val registerResult:LiveData<Resources<PasienRegisterResponse>>
            get() = _registerResult


    fun registerPasien(
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
    ) {
        viewModelScope.launch {
            _registerResult.postValue(Resources.loading(null))
            mainRepository.getRegisterResult(nik,nama,jenisKelamin,ttl,agama,pekerjaan,pendidikan,statusPerkawinan,noBpjs,noHP, password).let {
                val response = it
                if (it.isSuccessful){
                    _registerResult.postValue(Resources.success(response.body()))
                    Log.d(REGISTER, response.body()?.message.toString())
                }else{
                    val errResponse = it.errorBody()?.string()
                    it.errorBody()?.close()
                    _registerResult.postValue(Resources.error(errResponse,null))
                }
            }
        }

    }
    companion object{
        const val REGISTER = "Register View Model"
    }


}