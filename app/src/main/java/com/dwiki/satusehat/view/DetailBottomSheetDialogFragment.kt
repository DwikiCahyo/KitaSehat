package com.dwiki.satusehat.view

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.viewModels
import com.bumptech.glide.Glide
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.LayoutModalBottomSheetBinding
import com.dwiki.satusehat.viewmodel.DetailRumahSakitViewModel
import com.google.android.material.bottomsheet.BottomSheetDialogFragment

class DetailBottomSheetDialogFragment(
    val namaRs:String,
    val fotoRs:String
) : BottomSheetDialogFragment() {

    private var _binding: LayoutModalBottomSheetBinding? = null
    private val binding get() = _binding!!
    private val detailViewModel:DetailRumahSakitViewModel by viewModels()

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View {
       _binding = LayoutModalBottomSheetBinding.inflate(inflater,container,false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        binding.tvNamaRs.text = namaRs
        Glide.with(this)
            .load(fotoRs)
            .into(binding.ivProfileRumahSakit)
    }

    override fun getTheme(): Int {
        return R.style.CustomBottomSheetDialog
    }
}