package com.dwiki.satusehat.ui.pendaftaran

import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import android.os.Build
import android.os.Bundle
import android.util.Log
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.AdapterView
import android.widget.ArrayAdapter
import androidx.fragment.app.viewModels
import com.dwiki.satusehat.R
import com.dwiki.satusehat.data.responseModel.DataFasilitasRumahSakitItem
import com.dwiki.satusehat.databinding.FragmentPendaftaranUmumBinding
import com.dwiki.satusehat.model.RumahSakit
import com.dwiki.satusehat.ui.DashboardActivity
import com.dwiki.satusehat.ui.SuccessDialog
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.viewModel.FasilitasRumahSakitViewModel
import com.dwiki.satusehat.viewModel.PasienProfileViewModel
import com.dwiki.satusehat.viewModel.RegistrasiViewModel
import dagger.hilt.android.AndroidEntryPoint


@AndroidEntryPoint
class PendaftaranUmumFragment : Fragment() {

    private var _binding:FragmentPendaftaranUmumBinding? = null
    private val binding get() = _binding!!
    private lateinit var pref: SharedPreferences
    private val fasilitasViewModel: FasilitasRumahSakitViewModel by viewModels()
    private val registrasiViewModel: RegistrasiViewModel by viewModels()
    private lateinit var idFasilitas:String


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        _binding = FragmentPendaftaranUmumBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        pref = requireActivity().getSharedPreferences("login_pref", Context.MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")
        Log.d("BPJS Fragment ",token!!)

        val rumahSakitId = if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            requireActivity().intent.getParcelableExtra("data_rs", RumahSakit::class.java)
        } else {
            requireActivity().intent.getParcelableExtra("data_rs")
        }
        Log.d("BPJS Fragment ", rumahSakitId?.id.toString())
        Log.d("BPJS Fragment ", rumahSakitId?.nama.toString())

        getFasilitas(token,rumahSakitId?.id.toString())
        binding.btnSimpanData.setOnClickListener {
            val keluhan = binding.edtKeluhan.text.toString()
            postAntrean("antreanumum",token,idFasilitas,keluhan)
        }
    }

    private fun getFasilitas(token: String, idRs: String) {
        fasilitasViewModel.getFasilitas(token,idRs)
        fasilitasViewModel.responseFasilitasRs.observe(viewLifecycleOwner){fasilitas ->
            when(fasilitas.status){
                Status.SUCCESS ->{
                    val fasilitasResponse = fasilitas.data?.dataFasilitasRumahSakit
                    Log.d("BPJS FRAGMENT", fasilitas.data?.message ?: "Error load Fasilitas")
                    //convert response to list string for adapter spinner
                    val listFasilitas = mutableListOf<DataFasilitasRumahSakitItem>()
                    for(i in 0 until fasilitasResponse?.size!!){
                        listFasilitas.add(fasilitasResponse[i])
                    }
                    binding.edtFasilitaas.apply {
                        val namaFasilitas = listFasilitas.map {
                            it.fasilitasNamaLayanan
                        }
                        val adapter = ArrayAdapter(requireContext(), R.layout.dropdown_item, namaFasilitas)
                        setAdapter(adapter)
                        hint = "Pilih Fasilitas"
                        onItemClickListener = AdapterView.OnItemClickListener { parent, view, position, _ ->
                                if (listFasilitas[position].fasilitasNamaLayanan == namaFasilitas[position]){
                                    idFasilitas = listFasilitas[position].id.toString()
                                    Utils.makeToast(requireContext(),idFasilitas)
                                }
                        }
                    }

                }
                Status.ERROR->{
                    Log.e("BPJS FRAGMENT", fasilitas.message!!)
                }
                Status.LOADING->{
                    Log.d("BPJS Fragment","Loading Fasilitas")
                }
            }
        }

    }

    private fun postAntrean(jenisAntrean:String,token: String,idFasilitas:String,keluhan:String){
        registrasiViewModel.postRegistrasi(jenisAntrean,token,idFasilitas,keluhan)
        registrasiViewModel.responseRegistrasiAntrean.observe(viewLifecycleOwner){registrasi->
            when(registrasi.status){
                Status.SUCCESS->{
                    val registrasiResponse = registrasi.data?.message
                    val mmsg = "Pendaftaran Berhasil"
                    SuccessDialog(mmsg).show(requireActivity().supportFragmentManager,"Pendaftaran Berhasil")
                }
                Status.LOADING->{
                    Log.d("BPJS Fragment","Loading")
                }
                Status.ERROR->{
                    Log.e("BPJS FRAGMENT","${registrasi.message}")
                }
            }
        }
    }

}