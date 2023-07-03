package com.dwiki.satusehat.viewmodel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.model.responseModel.RegistrasiAntreanResponse
import dagger.hilt.android.lifecycle.HiltViewModel
import javax.inject.Inject
import com.dwiki.satusehat.util.Resources
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch

@HiltViewModel
class RegistrasiViewModel @Inject constructor(val repository: MainRepository):ViewModel() {

    private val _responseRegistrasiAntrean = MutableLiveData<Resources<RegistrasiAntreanResponse>>()
    val responseRegistrasiAntrean:LiveData<Resources<RegistrasiAntreanResponse>> = _responseRegistrasiAntrean

    fun postRegistrasi(jenisAntrean:String,token:String,idFasilitas:String,keluhan:String){
        viewModelScope.launch {
            repository.postRegistrasiPasien(jenisAntrean,token,idFasilitas,keluhan)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseRegistrasiAntrean.postValue(it)
                }
        }
    }
}