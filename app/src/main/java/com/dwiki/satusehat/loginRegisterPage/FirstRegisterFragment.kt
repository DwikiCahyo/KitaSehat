package com.dwiki.satusehat.loginRegisterPage

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.dwiki.satusehat.R
import com.dwiki.satusehat.databinding.FragmentFirstPageBinding
import com.dwiki.satusehat.databinding.FragmentFirstRegisterBinding


class FirstRegisterFragment : Fragment() {

    private var _binding: FragmentFirstRegisterBinding? = null
    private val binding get() = _binding!!

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        _binding = FragmentFirstRegisterBinding.inflate(inflater,container,false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
    }


}