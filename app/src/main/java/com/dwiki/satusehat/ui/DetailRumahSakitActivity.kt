package com.dwiki.satusehat.ui

import android.Manifest
import android.content.Intent
import android.content.SharedPreferences
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.graphics.Canvas
import android.graphics.Color
import android.graphics.drawable.ColorDrawable
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import android.widget.Toast
import androidx.activity.result.contract.ActivityResultContracts
import androidx.activity.viewModels
import androidx.annotation.ColorInt
import androidx.annotation.DrawableRes
import androidx.core.content.ContextCompat
import androidx.core.content.res.ResourcesCompat
import androidx.core.graphics.drawable.DrawableCompat
import androidx.recyclerview.widget.LinearLayoutManager
import com.bumptech.glide.util.Util
import com.dwiki.satusehat.R
import com.dwiki.satusehat.adapter.RumahSakitAdapter
import com.dwiki.satusehat.adapter.RumahSakitMapAdapter
import com.dwiki.satusehat.data.responseModel.ListRumahSakitItem
import com.dwiki.satusehat.databinding.ActivityDetailRumahSakitBinding
import com.dwiki.satusehat.ui.dialog.DialogDetailRumahSakit
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.viewModel.RumahSakitViewModel
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.*
import dagger.hilt.android.AndroidEntryPoint
import javax.annotation.meta.When

@AndroidEntryPoint
class DetailRumahSakitActivity : AppCompatActivity(), OnMapReadyCallback {
    private lateinit var gMap: GoogleMap
    private lateinit var binding:ActivityDetailRumahSakitBinding
    private lateinit var rsAdapter: RumahSakitMapAdapter
    private lateinit var pref: SharedPreferences
    private val viewModel: RumahSakitViewModel by viewModels()
    lateinit var token: String

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDetailRumahSakitBinding.inflate(layoutInflater)
        setContentView(binding.root)

        window.statusBarColor = ContextCompat.getColor(this,R.color.white)
        supportActionBar?.title = "Informasi Rumah Sakit"
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val colorDrawable = ColorDrawable(ContextCompat.getColor(this,R.color.white))
        supportActionBar?.setBackgroundDrawable(colorDrawable)

        //get token
        pref = getSharedPreferences("login_pref", MODE_PRIVATE)
        token = pref.getString("key_token","KOSONG")!!

        if (token != null) {
            getListRumahsakit(token)
        }

        rsAdapter = RumahSakitMapAdapter(ArrayList())

        val mapFragment = supportFragmentManager.findFragmentById(R.id.layout_maps) as SupportMapFragment
        mapFragment.getMapAsync(this)
    }

    private fun initRecycleView() {
        binding.rvListRs.apply {
            adapter = rsAdapter
            layoutManager = LinearLayoutManager(this@DetailRumahSakitActivity, LinearLayoutManager.VERTICAL,false)
            setHasFixedSize(true)
        }
    }

    override fun onMapReady(googleMap: GoogleMap) {


        gMap = googleMap
        gMap.setMapStyle(
            MapStyleOptions.loadRawResourceStyle(
                this,
                R.raw.map_style
            )
        )
        gMap.uiSettings.isZoomControlsEnabled = true
        gMap.uiSettings.isIndoorLevelPickerEnabled = true
        gMap.uiSettings.isCompassEnabled = true
        gMap.uiSettings.isMapToolbarEnabled = true

        getMyLocation()
        getListRumahsakit(token)
    }

    private fun getListRumahsakit(token:String) {
        val boundsBuilder = LatLngBounds.Builder()
        viewModel.getRumahSakit(token)
        viewModel.responseRumahSakit.observe(this){ list ->
            when(list.status){

                Status.SUCCESS->{
                    val rumahSakitResponse = list.data
                    if(rumahSakitResponse != null){
                        val listRs = rumahSakitResponse.listRumahSakit
                        rsAdapter.getItem(listRs)
                        initRecycleView()

                        for (i in listRs.indices) {
                            val lon = listRs[i].koordinat.coordinates[0] as Double
                            val lat = listRs[i].koordinat.coordinates[1] as Double

                            val latLon = LatLng(lon, lat)
                            Log.d("Detail Rs", "$latLon")

                            gMap.addMarker(
                                MarkerOptions()
                                    .position(latLon)
                                    .title(listRs[i].nama)
                                    .snippet("${listRs[i].daerah.jenis}, ${listRs[i].daerah.namaDaerah}")
                                    .icon(vectorToBitmap(R.drawable.baseline_local_hospital_24, Color.RED))
                            )

                            boundsBuilder.include(latLon)
                            val bounds: LatLngBounds = boundsBuilder.build()
                            gMap.animateCamera(CameraUpdateFactory.newLatLngBounds(bounds, 64))

                        }

                        //button onclick
                        rsAdapter.setOnItemClickCallback(object :RumahSakitMapAdapter.OnItemClickCallback{
                            override fun onItemClicked(listRumahSakit: ListRumahSakitItem) {
                                val intent = Intent(this@DetailRumahSakitActivity,DetailRsActivity::class.java)
                                val bundle = Bundle()
                                bundle.putString("nama", listRumahSakit.nama)
                                bundle.putString("namaDaerah",listRumahSakit.daerah.namaDaerah)
                                bundle.putString("jenisDaerah",listRumahSakit.daerah.jenis)
                                bundle.putInt("id",listRumahSakit.id)
                                bundle.putString("url",listRumahSakit.fotoRumahSakit)
                                intent.putExtras(bundle)
                                startActivity(intent)
                            }
                        })

                        rsAdapter.setOnLocationClickCallBack(object :RumahSakitMapAdapter.OnMapClickCallback{
                            override fun onMapClicked(listRumahSakit: ListRumahSakitItem) {

                            if (listRumahSakit.koordinat != null) {
                                val lon =  listRumahSakit.koordinat.coordinates[0]
                                val lat =  listRumahSakit.koordinat.coordinates[1]
                                val uri = Uri.parse("google.navigation:q=$lon,$lat&mode=d")
                                val mapIntent = Intent(Intent.ACTION_VIEW,uri)
                                startActivity(mapIntent)
                            } else{
                                Utils.makeToast(this@DetailRumahSakitActivity,"Koordinat tidak ditemukan")
                            }
                            }
                        })
                        Log.d(PendaftaranRumahSakitActivity.TAG,rumahSakitResponse.message)
                    }
                }
                Status.ERROR->{

                    Log.e(DashboardActivity.TAG, "Error : ${list.message}")
                }
                Status.LOADING->{

                    Log.d(PendaftaranRumahSakitActivity.TAG, "Loading")
                }
            }

        }
    }

//    convert vector to bitmap for icon in map
    private fun vectorToBitmap(@DrawableRes id: Int, @ColorInt color: Int): BitmapDescriptor {
        val vectorDrawable = ResourcesCompat.getDrawable(resources, id, null)
        if (vectorDrawable == null) {
            Log.e("BitmapHelper", "Resource not found")
            return BitmapDescriptorFactory.defaultMarker()
        }
        val bitmap = Bitmap.createBitmap(
            vectorDrawable.intrinsicWidth,
            vectorDrawable.intrinsicHeight,
            Bitmap.Config.ARGB_8888
        )
        val canvas = Canvas(bitmap)
        vectorDrawable.setBounds(0, 0, canvas.width, canvas.height)
        DrawableCompat.setTint(vectorDrawable, color)
        vectorDrawable.draw(canvas)
        return BitmapDescriptorFactory.fromBitmap(bitmap)
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