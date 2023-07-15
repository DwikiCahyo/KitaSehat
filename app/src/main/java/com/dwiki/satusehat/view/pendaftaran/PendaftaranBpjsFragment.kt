package com.dwiki.satusehat.view.pendaftaran

import android.content.Context
import android.content.SharedPreferences
import android.os.Build
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.AdapterView
import android.widget.ArrayAdapter
import androidx.fragment.app.Fragment
import androidx.fragment.app.viewModels
import com.dwiki.satusehat.R
import com.dwiki.satusehat.model.responseModel.DataFasilitasRumahSakitItem
import com.dwiki.satusehat.databinding.FragmentPendaftaranBpjsBinding
import com.dwiki.satusehat.model.RumahSakit
import com.dwiki.satusehat.view.dialog.DialogFragmentInformasiBuka
import com.dwiki.satusehat.view.dialog.SuccessDialog
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.viewmodel.FasilitasRumahSakitViewModel
import com.dwiki.satusehat.viewmodel.PasienProfileViewModel
import com.dwiki.satusehat.viewmodel.RegistrasiViewModel
import com.shashank.sony.fancytoastlib.FancyToast
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class PendaftaranBpjsFragment : Fragment() {

    private var _binding:FragmentPendaftaranBpjsBinding? =null
    private val binding get() = _binding!!
    private lateinit var pref: SharedPreferences
    private val profileViewModel:PasienProfileViewModel by viewModels()
    private val fasilitasViewModel:FasilitasRumahSakitViewModel by viewModels()
    private val registrasiViewModel:RegistrasiViewModel by viewModels()
    private lateinit var idFasilitas:String



    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        _binding = FragmentPendaftaranBpjsBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        pref = requireActivity().getSharedPreferences("login_pref",Context.MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")
        Log.d("BPJS Fragment ",token!!)

        val rumahSakitId = if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            requireActivity().intent.getParcelableExtra("data_rs",RumahSakit::class.java)
        } else {
            requireActivity().intent.getParcelableExtra("data_rs")
        }

        val editor = pref.edit()
        editor.putString("id", rumahSakitId?.id.toString())
        editor.apply()

        fasilitasViewModel.getId(rumahSakitId?.id.toString())

        Log.d("BPJS Fragment ", rumahSakitId?.id.toString())


        getProfilePasien(token)
        getFasilitas(token,rumahSakitId?.id.toString())

        binding.btnSimpanData.setOnClickListener {
            val keluhan = binding.edtKeluhan.text.toString()
            if (keluhan.isNullOrEmpty() || idFasilitas.isNullOrEmpty()){
                FancyToast.makeText(requireContext(),"Mohon isi form terlebih dahulu",FancyToast.LENGTH_SHORT,FancyToast.ERROR,false).show()
            } else{
                postAntrean("antreanbpjs",token,idFasilitas,keluhan)
            }
        }
        binding.btnInformasi.setOnClickListener {
            val infoBottomSheet = DialogFragmentInformasiBuka()
            infoBottomSheet.show(childFragmentManager,"informasi jam buka")

        }



    }

    private fun getFasilitas(token: String, idRs: String) {
        fasilitasViewModel.getFasilitas(token,idRs)
        fasilitasViewModel.responseFasilitasRs.observe(viewLifecycleOwner){fasilitas ->
            when(fasilitas.status){

                Status.SUCCESS ->{
                    val fasilitasResponse = fasilitas.data?.dataFasilitasRumahSakit
                    //convert response to list string for adapter spinner
                    val listFasilitas = mutableListOf<DataFasilitasRumahSakitItem>()
                    for(i in 0 until fasilitasResponse?.size!!){
                        Log.d("BPJS fragment fasilitas","nama fasilitas : ${fasilitasResponse[i]?.fasilitasNamaLayanan}, id fasilitas: ${fasilitasResponse[i]?.id}")
                        listFasilitas.add(fasilitasResponse[i]!!)
                    }

                    //setup for spinner
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


    private fun getProfilePasien(token:String) {
       profileViewModel.getProfile(token).observe(viewLifecycleOwner){ pasien ->
           when(pasien.status){
               Status.SUCCESS->{
                   val noBpjsPasien = pasien.data?.dataPasien?.noBpjs
                   Log.d("BPJS Fragment no",noBpjsPasien.toString())
                   if (noBpjsPasien != null) {
                       if (noBpjsPasien.isNotEmpty()){
                           binding.tvNoBpjs.text = noBpjsPasien
                           binding.btnSimpanData.isEnabled = true
                       } else {
                           binding.tvNoBpjs.letterSpacing = 0.0F
                           binding.tvNoBpjs.text = "Masukan dahulu nomer BPJS anda"
                           binding.btnSimpanData.isEnabled = false


                       }
                   } else {
                       binding.tvNoBpjs.letterSpacing = 0.0F
                       binding.tvNoBpjs.text = "Masukan dahulu nomer BPJS anda"
                       binding.btnSimpanData.isEnabled = false
                   }
               }
               Status.LOADING ->{
                   Log.d("BPJS Fragment","Loading Profile")
               }
               Status.ERROR ->{
                   Log.e("BPJS FRAGMENt","${pasien.message}")
               }
           }
       }
    }


}