package com.dwiki.satusehat.viewModel


import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.data.responseModel.DetailRumahSakitResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class DetailRumahSakitViewModel @Inject constructor(private val mainRepository: MainRepository):ViewModel() {

    private val _responseDetailRumahsakit = MutableLiveData<Resources<DetailRumahSakitResponse>>()
    val responseDetailRumahSakitResponse:LiveData<Resources<DetailRumahSakitResponse>> = _responseDetailRumahsakit

    fun getDetailRumahSakit(token:String,id:Int){
        viewModelScope.launch {
            mainRepository.getDetailRumahSakit(token,id)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseDetailRumahsakit.postValue(it)
                    Log.d("DetailRumahSakitViewModel","${it.data}")
                }
        }
    }
}