package com.dwiki.satusehat.viewmodel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.model.responseModel.RiwayatPendaftaranResponse
import com.dwiki.satusehat.model.responseModel.RiwayatPendaftaranUmumResponse
import dagger.hilt.android.lifecycle.HiltViewModel
import javax.inject.Inject
import com.dwiki.satusehat.util.Resources
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch

@HiltViewModel
class RiwayatPendaftaranViewModel @Inject constructor(val repository: MainRepository):ViewModel() {

    private val _responseRiwayatPendaftaraan = MutableLiveData<Resources<RiwayatPendaftaranResponse>>()
    val responseRiwayatPendaftaran:LiveData<Resources<RiwayatPendaftaranResponse>> = _responseRiwayatPendaftaraan


    private val _responseRiwayatPendaftaraanUmum = MutableLiveData<Resources<RiwayatPendaftaranUmumResponse>>()
    val responseRiwayatPendaftaranUmum:LiveData<Resources<RiwayatPendaftaranUmumResponse>> = _responseRiwayatPendaftaraanUmum

    fun getRiwayatPendaftaran(token:String){
        viewModelScope.launch {
            repository.getRiwayatPendaftaran(token)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseRiwayatPendaftaraan.postValue(it)
                }
        }
    }

    fun getRiwayatPendaftaranUmum(token: String){
        viewModelScope.launch {
            repository.getRiwayatPendaftaranUmum(token)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseRiwayatPendaftaraanUmum.postValue(it)
                }
        }
    }
}