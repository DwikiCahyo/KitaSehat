package com.dwiki.satusehat.viewmodel

import androidx.lifecycle.*
import com.dwiki.satusehat.PreferenceManager
import com.dwiki.satusehat.data.repository.MainRepository
import com.dwiki.satusehat.model.responseModel.EditFotoProfileResponse
import com.dwiki.satusehat.model.responseModel.KontakDaruratResponse
import com.dwiki.satusehat.model.responseModel.ProfileItemResponse
import com.dwiki.satusehat.util.Resources
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.flowOn
import kotlinx.coroutines.launch
import okhttp3.MultipartBody
import javax.inject.Inject

@HiltViewModel
class PasienProfileViewModel @Inject constructor(private val mainRepository: MainRepository,private val preferenceManager: PreferenceManager):ViewModel() {
    fun getProfile(token:String) = mainRepository.getProfilePasien(token)

    private val _responseEditProfile = MutableLiveData<Resources<ProfileItemResponse>>()
    val responseEditProfile:LiveData<Resources<ProfileItemResponse>> = _responseEditProfile

    private val _responseEditFotoProfile = MutableLiveData<Resources<EditFotoProfileResponse>>()
    val responseEditFotoProfile:LiveData<Resources<EditFotoProfileResponse>> = _responseEditFotoProfile

    private val _responseKontakDarurat = MutableLiveData<Resources<KontakDaruratResponse>>()
    val responseKontakDarurat:LiveData<Resources<KontakDaruratResponse>> = _responseKontakDarurat

    private val _responseItemKontakDarurat = MutableLiveData<Resources<EditFotoProfileResponse>>()
    val responseItemKontakDarurat:LiveData<Resources<EditFotoProfileResponse>> = _responseItemKontakDarurat



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

    fun uploadImage(
        token:String,
        image:MultipartBody.Part
    ) {
        viewModelScope.launch {
            mainRepository.editFotoProfil(token, image)
                .flowOn(Dispatchers.IO)
                .collect {
                    _responseEditFotoProfile.postValue(it)
                }
        }
    }

    fun postKontakDarurat(
        token: String,
        name:String,
        noTelepon:String
    ){
        viewModelScope.launch {
            mainRepository.postKontakDarurat(token, name, noTelepon)
                .flowOn(Dispatchers.IO)
                .collect {
                    _responseItemKontakDarurat.postValue(it)
                }
        }
    }

    fun getKontakDarurat(token: String) {
        viewModelScope.launch {
            mainRepository.getKontakDarurat(token)
                .flowOn(Dispatchers.IO)
                .collect {
                    _responseKontakDarurat.postValue(it)
                }
        }
    }

    companion object{
        const val TAG ="Pasien Profile ViewModel"
    }
}

