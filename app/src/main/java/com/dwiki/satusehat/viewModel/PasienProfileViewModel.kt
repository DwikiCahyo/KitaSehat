package com.dwiki.satusehat.viewModel

import android.util.Log
import androidx.lifecycle.*
import com.dwiki.satusehat.PreferenceManager
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.data.responseModel.PasienProfileResponse
import com.dwiki.satusehat.data.responseModel.ProfileItemResponse
import com.dwiki.satusehat.data.responseModel.RegistrasiAntreanResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.collect
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class PasienProfileViewModel @Inject constructor(private val mainRepository: MainRepository,private val preferenceManager: PreferenceManager):ViewModel() {
    fun getProfile(token:String) = mainRepository.getProfilePasien(token)

    private val _responseEditProfile = MutableLiveData<Resources<ProfileItemResponse>>()
    val responseEditProfile:LiveData<Resources<ProfileItemResponse>> = _responseEditProfile
    fun editProfile(
        token: String,
        nama:String,
        jenisKelamin:String,
        ttl:String,
        agama:String,
        pekerjaan: String,
        pendidikan: String,
        statusPerkawinan: String,
        noBpjs: String,
        noHP: String,
    ){
        viewModelScope.launch {
            mainRepository.editProfilePasien(token, nama, jenisKelamin, ttl, agama, pekerjaan, pendidikan, statusPerkawinan, noBpjs, noHP)
                .flowOn(Dispatchers.IO)
                .collect{
                    _responseEditProfile.postValue(it)
                }
        }
    }

    companion object{
        const val TAG ="Pasien Profile ViewModel"
    }
}

