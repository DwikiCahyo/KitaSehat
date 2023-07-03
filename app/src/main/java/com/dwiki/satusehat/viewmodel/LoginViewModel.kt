package com.dwiki.satusehat.viewmodel

import androidx.lifecycle.*
import com.dwiki.satusehat.data.repository.MainRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import javax.inject.Inject

@HiltViewModel
class LoginViewModel @Inject constructor (private val mainRepository: MainRepository):ViewModel() {
    fun loginPasien(nik: String,password: String) = mainRepository.loginResult(nik,password)
    companion object{
        const val LOGIN_VIEW_MODEL = "Login View Model"
    }
}