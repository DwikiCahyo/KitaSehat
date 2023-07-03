package com.dwiki.satusehat.viewmodel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.model.responseModel.BatalkanAntreanResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class StatusAntreanViewModel @Inject constructor( private val repository: MainRepository):ViewModel() {

    fun getStatusAntrean(token:String) = repository.getStatusAntreanRepository(token)
    fun getStatusAntreanLive(token: String) = repository.getAntreanLive(token)

    private val _responseBatalkan = MutableLiveData<Resources<BatalkanAntreanResponse>>()
    val responseBatalkan: LiveData<Resources<BatalkanAntreanResponse>> = _responseBatalkan
    fun batalkanAntrean(token: String,antreanId:Int,jenisPasien:String) {
        viewModelScope.launch {
            repository.postBatalkanAntrean(token,antreanId,jenisPasien)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseBatalkan.postValue(it)
                }
        }
    }
}