package com.dwiki.satusehat.viewmodel

import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import com.dwiki.satusehat.data.api.ApiService
import com.dwiki.satusehat.model.responseModel.ListImageSliderItem
import com.dwiki.satusehat.model.responseModel.ResponseImageSlider
import dagger.hilt.android.lifecycle.HiltViewModel
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import javax.inject.Inject


@HiltViewModel
class SliderViewModel @Inject constructor(private val apiService: ApiService):ViewModel() {


    private val _getImageSlider = MutableLiveData<List<ListImageSliderItem>>()
    val getImageSlider:LiveData<List<ListImageSliderItem>> = _getImageSlider

    fun imageSlider(){
        apiService.getImageSlider().enqueue(object : Callback<ResponseImageSlider>{
            override fun onResponse(
                call: Call<ResponseImageSlider>,
                response: Response<ResponseImageSlider>
            ) {
                if (response.isSuccessful){
                    _getImageSlider.value  = response.body()?.listImageSlider
                } else {
                    Log.e("Slider View Model", response.errorBody()?.string() ?: "Error")
                }
            }

            override fun onFailure(call: Call<ResponseImageSlider>, t: Throwable) {
                Log.e("Slider View Model", t.cause.toString())
            }

        }
        )
    }
}