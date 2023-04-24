package com.dwiki.satusehat.viewModel

import android.util.Log
import androidx.lifecycle.*
import com.dwiki.satusehat.PreferenceManager
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.data.responseModel.PasienProfileResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class PasienProfileViewModel @Inject constructor(private val mainRepository: MainRepository,private val preferenceManager: PreferenceManager):ViewModel() {
    fun getProfile(token:String) = mainRepository.getProfilePasien(token)

    companion object{
        const val TAG ="Pasien Profile ViewModel"
    }
}

