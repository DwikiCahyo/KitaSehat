package com.dwiki.satusehat.viewModel

import androidx.lifecycle.ViewModel
import com.dwiki.satusehat.data.repository.MainRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import javax.inject.Inject

@HiltViewModel
class PasienProfileViewModel @Inject constructor(private val mainRepository: MainRepository):ViewModel() {

    fun getProfile(token:String) = mainRepository.getProfilePasien(token)
}