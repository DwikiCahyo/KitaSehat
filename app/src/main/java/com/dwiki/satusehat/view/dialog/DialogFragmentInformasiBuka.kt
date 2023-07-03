package com.dwiki.satusehat.view.dialog

import android.content.Context
import android.content.SharedPreferences
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.viewModels
import androidx.recyclerview.widget.DividerItemDecoration
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.adapter.InformasiBukaAdapter
import com.dwiki.satusehat.databinding.FragmentDialogInformasiBukaBinding
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewmodel.FasilitasRumahSakitViewModel
import com.google.android.material.bottomsheet.BottomSheetDialogFragment
import dagger.hilt.android.AndroidEntryPoint


@AndroidEntryPoint
class DialogFragmentInformasiBuka :BottomSheetDialogFragment() {

    private lateinit var binding:FragmentDialogInformasiBukaBinding
    private val fasilitasRumahSakitViewModel:FasilitasRumahSakitViewModel by viewModels()
    private lateinit var pref: SharedPreferences
    private lateinit var informasiBukaAdapter: InformasiBukaAdapter

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        binding = FragmentDialogInformasiBukaBinding.inflate(inflater, container, false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        pref = requireActivity().getSharedPreferences("login_pref", Context.MODE_PRIVATE)
        val token  = pref.getString("key_token","KOSONG")
        val id = pref.getString("id","KOSONG")
        Log.d("Bottom Sheet", "$token")

            fasilitasRumahSakitViewModel.getFasilitas(token!!,id!!)
            fasilitasRumahSakitViewModel.responseFasilitasRs.observe(viewLifecycleOwner){ fasilitas ->
               if (fasilitas.status == Status.SUCCESS){
                    binding.rvInformasiRumahSakit.apply {
                        layoutManager = LinearLayoutManager(requireContext(), RecyclerView.VERTICAL,false)
                        informasiBukaAdapter = InformasiBukaAdapter(fasilitas.data!!.dataFasilitasRumahSakit)
                        adapter  = informasiBukaAdapter
                        addItemDecoration(DividerItemDecoration(requireContext(), LinearLayoutManager.VERTICAL))
                    }
               }
            }
    }

}