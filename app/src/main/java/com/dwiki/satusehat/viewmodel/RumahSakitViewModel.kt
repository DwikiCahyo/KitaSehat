package com.dwiki.satusehat.viewmodel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.model.responseModel.RumahSakitResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class RumahSakitViewModel @Inject constructor(val repository: MainRepository):ViewModel() {

    private val _responseRumahSakit = MutableLiveData<Resources<RumahSakitResponse>>()
    val responseRumahSakit:LiveData<Resources<RumahSakitResponse>> = _responseRumahSakit

    fun getRumahSakit(token:String){
        viewModelScope.launch {
            repository.getRumahSakit(token)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseRumahSakit.postValue(it)
                }

        }
    }
}