package com.dwiki.satusehat.viewModel

import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.data.responseModel.GetRumahSakitItem
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class MainViewModel @Inject constructor(
    private val mainRepository: MainRepository
):ViewModel() {

    private val _rumahSakit = MutableLiveData<Resources<List<GetRumahSakitItem>>>()
    val rumahSakit:LiveData<Resources<List<GetRumahSakitItem>>>
        get() = _rumahSakit

    init {
        fetchRumahSakit()
    }

     fun fetchRumahSakit() {
        viewModelScope.launch {

            _rumahSakit.postValue(Resources.loading(null))
            mainRepository.getRumahSakit().let {
                //try to use flow
                if (it.isSuccessful){
                    val responseBody = it.body()

                    if (responseBody != null) {
                        _rumahSakit.postValue(Resources.success(responseBody.getRumahSakit))
                    } else{
                        _rumahSakit.postValue(Resources.error("Data not Found",null))
                    }

                    Log.d(MAIN_VIEW_MODEL, it.body().toString())
                }else{
                    _rumahSakit.postValue(Resources.error("Error Server",null))
                }
            }
        }
    }

    companion object{
        const val MAIN_VIEW_MODEL= "MainViewModel"
    }
}