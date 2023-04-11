package com.dwiki.satusehat.viewModel

import android.util.Log
import androidx.lifecycle.*
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.data.responseModel.PasienLoginResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class LoginViewModel @Inject constructor (private val mainRepository: MainRepository):ViewModel() {

//    private val _loginResult = MutableLiveData<Resources<PasienLoginResponse>>()
//
//    val loginResult:LiveData<Resources<PasienLoginResponse>>
//        get() = _loginResult.distinctUntilChanged()
//
//    private val _message = MutableLiveData<String>()
//    val message: LiveData<String> = _message
//
//
//    fun login(nik:String, password:String){
//        viewModelScope.launch {
//
//            mainRepository.getLoginResul(nik,password)
//            _loginResult.postValue(Resources.loading(null))
//            mainRepository.getLoginResul(nik,password).let {
//                if (it.isSuccessful){
//                    _loginResult.postValue(Resources.success(it.body()))
//                    Log.d(LOGIN_VIEW_MODEL, it?.body()?.message.toString())
//                }else{
//                    val errResponse = it.errorBody()?.string()
//                    it.errorBody()?.close()
//                    _loginResult.postValue(Resources.error(errResponse,null))
//                }
//            }
//        }
//    }

    fun loginPasien(nik: String,password: String) = mainRepository.loginResult(nik,password)

    companion object{
        const val LOGIN_VIEW_MODEL = "Login View Model"
    }
}