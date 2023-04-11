package com.dwiki.satusehat.viewModel

import androidx.lifecycle.LiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.asLiveData
import androidx.lifecycle.viewModelScope
import com.dwiki.satusehat.PreferenceManager
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class StateViewModel @Inject constructor(private val prefManager: PreferenceManager):ViewModel() {

    //token
    fun getToken():LiveData<String>{
        return prefManager.getToken().asLiveData()
    }

    fun saveToken(token:String){
        viewModelScope.launch {
            prefManager.saveToken(token)
        }
    }

    //state
    fun getLoginState():LiveData<Boolean>{
        return prefManager.getLoginState().asLiveData()
    }

    fun saveLoginState(state:Boolean){
        viewModelScope.launch {
            prefManager.saveLoginState(state)
        }
    }

    fun logout(){
        viewModelScope.launch {
            prefManager.logout()
        }
    }
}