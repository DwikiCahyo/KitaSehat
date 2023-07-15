package com.dwiki.satusehat.viewmodel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.model.responseModel.FasilitasRumahSakitResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class FasilitasRumahSakitViewModel @Inject constructor(val repository: MainRepository):ViewModel() {

    private val _responseFasilitasRs =MutableLiveData<Resources<FasilitasRumahSakitResponse>>()
    val responseFasilitasRs:LiveData<Resources<FasilitasRumahSakitResponse>> = _responseFasilitasRs

    private val _getIdRs = MutableLiveData<String>()
    val getIdRs:LiveData<String> = _getIdRs

    fun getId(id:String){
        _getIdRs.value = id
    }

    fun getFasilitas(token:String, idRs:String){
        viewModelScope.launch {
            repository.getFasilitasRumahSakit(token,idRs)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseFasilitasRs.postValue(it)
                }
        }
    }
}