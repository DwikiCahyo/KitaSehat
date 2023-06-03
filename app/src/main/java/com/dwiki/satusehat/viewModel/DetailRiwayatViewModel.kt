package com.dwiki.satusehat.viewModel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.data.responseModel.DetailRiwayatResponse
import com.dwiki.satusehat.data.responseModel.RumahSakitResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.collect
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class DetailRiwayatViewModel @Inject constructor(private val repository: MainRepository):ViewModel() {

    private val _responseDetailRiwayatBPJs = MutableLiveData<Resources<DetailRiwayatResponse>>()
    val responseDetailRiwayatBPJs: LiveData<Resources<DetailRiwayatResponse>> = _responseDetailRiwayatBPJs

    private val _responseDetailRiwayatUmum = MutableLiveData<Resources<DetailRiwayatResponse>>()
    val responseDetailRiwayatUmum : LiveData<Resources<DetailRiwayatResponse>> = _responseDetailRiwayatUmum

    fun getDetailRiwayatBpjs(token:String,id:Int){
        viewModelScope.launch {
            repository.getDetailRiwayatBpjs(token,id)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseDetailRiwayatBPJs.postValue(it)
                }
        }
    }

    fun getDetailRiwayatUmum(token: String,id: Int){
        viewModelScope.launch {
            repository.getDetailRiwayatUmum(token,id)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseDetailRiwayatUmum.postValue(it)
                }
        }
    }
}