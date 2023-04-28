package com.dwiki.satusehat.ui

import android.Manifest
import android.content.Intent
import android.content.SharedPreferences
import android.content.pm.PackageManager
import android.graphics.drawable.ColorDrawable
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import androidx.activity.result.contract.ActivityResultContracts
import androidx.activity.viewModels
import androidx.core.content.ContextCompat
import androidx.recyclerview.widget.LinearLayoutManager
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.RumahSakitAdapter
import com.dwiki.satusehat.adapter.RumahSakitMapAdapter
import com.dwiki.satusehat.data.responseModel.ListRumahSakitItem
import com.dwiki.satusehat.databinding.ActivityDetailRumahSakitBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.viewModel.RumahSakitViewModel
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.MapStyleOptions
import com.google.android.gms.maps.model.MarkerOptions
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class DetailRumahSakitActivity : AppCompatActivity() {
    private lateinit var gMap: GoogleMap
    private lateinit var binding:ActivityDetailRumahSakitBinding
    private lateinit var rsAdapter: RumahSakitMapAdapter
    private lateinit var pref: SharedPreferences
    private val viewModel: RumahSakitViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDetailRumahSakitBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Rumah Sakit"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        //get token
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        val token = pref.getString("key_token","KOSONG")

        if (token != null) {
            getListRumahsakit(token)
        }

        rsAdapter = RumahSakitMapAdapter(ArrayList())

//        val mapFragment = supportFragmentManager.findFragmentById(R.id.layout_maps) as SupportMapFragment
//        mapFragment.getMapAsync(this)
    }

    private fun initRecycleView() {
        binding.rvListRs.apply {
            adapter = rsAdapter
            layoutManager = LinearLayoutManager(this@DetailRumahSakitActivity, LinearLayoutManager.VERTICAL,false)
            setHasFixedSize(true)
        }
    }

//    override fun onMapReady(googleMap: GoogleMap) {
//        gMap = googleMap
//        gMap.setMapStyle(
//            MapStyleOptions.loadRawResourceStyle(
//                this,
//                R.raw.map_style
//            )
//        )
//        gMap.uiSettings.isZoomControlsEnabled = true
//        gMap.uiSettings.isIndoorLevelPickerEnabled = true
//        gMap.uiSettings.isCompassEnabled = true
//        gMap.uiSettings.isMapToolbarEnabled = true
//
//        val dicodingSpace = LatLng(-6.8957643, 107.6338462)
//        gMap.addMarker(
//            MarkerOptions()
//                .position(dicodingSpace)
//                .title("Dicoding Space")
//                .snippet("Batik Kumeli No.50")
//        )
//        gMap.animateCamera(CameraUpdateFactory.newLatLngZoom(dicodingSpace, 15f))
//
//        getMyLocation()
//    }

    private fun getListRumahsakit(token:String) {
        viewModel.getRumahSakit(token)
        viewModel.responseRumahSakit.observe(this){ listRS ->
            when(listRS.status){

                Status.SUCCESS->{
                    val rumahSakitResponse = listRS.data
                    if(rumahSakitResponse != null){
                        val listRs = rumahSakitResponse.listRumahSakit
                        rsAdapter.getItem(listRs)
                        initRecycleView()
                        rsAdapter.setOnItemClickCallback(object :RumahSakitMapAdapter.OnItemClickCallback{
                            override fun onItemClicked(listRumahSakit: ListRumahSakitItem) {
                               Utils.makeToast(this@DetailRumahSakitActivity, listRumahSakit.nama)
                            }
                        })

                        rsAdapter.setOnLocationClickCallBack(object :RumahSakitMapAdapter.OnMapClickCallback{
                            override fun onMapClicked(listRumahSakit: ListRumahSakitItem) {
                             val lon =  listRumahSakit.koordinat.coordinates[0]
                             val lat =  listRumahSakit.koordinat.coordinates[1]
                             val uri = Uri.parse("google.navigation:q=$lon,$lat&mode=d")
                             val mapIntent = Intent(Intent.ACTION_VIEW,uri)
                             startActivity(mapIntent)
                             Utils.makeToast(this@DetailRumahSakitActivity,"Lon : $lon , Lat : $lat")
                            }

                        })
                        Log.d(PendaftaranRumahSakitActivity.TAG,rumahSakitResponse.message)
                    }
                }
                Status.ERROR->{

                    Log.e(DashboardActivity.TAG, "Error : ${listRS.message}")
                }
                Status.LOADING->{

                    Log.d(PendaftaranRumahSakitActivity.TAG, "Loading")
                }
            }

        }
    }

    private val requestPermissionLauncher = registerForActivityResult(
        ActivityResultContracts.RequestPermission()
    ) { isGranted: Boolean ->
        if (isGranted) {
            getMyLocation()
        }
    }

    private fun getMyLocation() {
        if (ContextCompat.checkSelfPermission(this.applicationContext, Manifest.permission.ACCESS_FINE_LOCATION,) == PackageManager.PERMISSION_GRANTED
        ) {
            gMap.isMyLocationEnabled = true
        } else {
            requestPermissionLauncher.launch(Manifest.permission.ACCESS_FINE_LOCATION)
        }
    }
}