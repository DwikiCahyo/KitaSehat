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


    fun loginPasien(nik: String,password: String) = mainRepository.loginResult(nik,password)

    companion object{
        const val LOGIN_VIEW_MODEL = "Login View Model"
    }
}