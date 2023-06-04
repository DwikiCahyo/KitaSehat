package com.dwiki.satusehat.viewModel

import androidx.lifecycle.ViewModel
import com.dwiki.satusehat.data.repository.MainRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import javax.inject.Inject

@HiltViewModel
class StatusAntreanViewModel @Inject constructor( private val repository: MainRepository):ViewModel() {

    fun getStatusAntrean(token:String) = repository.getStatusAntreanRepository(token)
    fun getStatusAntreanLive(token: String) = repository.getAntreanLive(token)
}