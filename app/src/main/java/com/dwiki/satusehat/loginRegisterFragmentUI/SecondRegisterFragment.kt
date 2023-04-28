package com.dwiki.satusehat.loginRegisterFragmentUI

import android.app.Activity
import android.app.DatePickerDialog
import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.util.Log
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.AdapterView
import android.widget.ArrayAdapter
import androidx.appcompat.app.AlertDialog
import androidx.fragment.app.viewModels
import com.dwiki.satusehat.util.KeyboardUtils
import com.dwiki.satusehat.R
import com.dwiki.satusehat.data.responseModel.DataFasilitasRumahSakitItem
import com.dwiki.satusehat.data.responseModel.ListRumahSakitItem
import com.dwiki.satusehat.util.Utils
import com.dwiki.satusehat.databinding.FragmentSecondRegisterBinding
import com.dwiki.satusehat.ui.DashboardActivity
import com.dwiki.satusehat.ui.LoadingDialog
import com.dwiki.satusehat.util.Status
import com.dwiki.satusehat.viewModel.RegisterViewModel
import com.dwiki.satusehat.viewModel.StateViewModel
import dagger.hilt.android.AndroidEntryPoint
import dagger.hilt.android.internal.managers.FragmentComponentManager
import org.json.JSONObject
import org.json.JSONTokener
import java.util.*


@AndroidEntryPoint
class SecondRegisterFragment : Fragment() {

    private var _binding: FragmentSecondRegisterBinding? = null
    private val binding get() = _binding!!
    private lateinit var pref: SharedPreferences

    private val keyboardUtils = KeyboardUtils
    private val utils =  Utils
    private lateinit var pekerjaan:String
    private lateinit var agama:String
    private lateinit var perkawinan:String
    private lateinit var pendidikan:String
    private lateinit var jenisKelamin:String
    private lateinit var tanggalLahir:String

    private val registerViewModel:RegisterViewModel by viewModels()
    private val stateViewModel:StateViewModel by viewModels()


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        _binding = FragmentSecondRegisterBinding.inflate(inflater,container,false)
        return binding.root
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)



        val hintAgama = resources.getStringArray(R.array.agama)
        val hintPekerjaan = resources.getStringArray(R.array.pekerjaan)
        val hintPerkawinan = resources.getStringArray(R.array.status_perkawinan)
        val hintPendidikan = resources.getStringArray(R.array.pendidikan)
        val hintJenisKelamin = resources.getStringArray(R.array.jenis_kelamin)
         val loading = LoadingDialog(requireContext())

        // setup for form pendaftaraan
        formPekerjaan(hintPekerjaan)
        formAgama(hintAgama)
        formPerkawinan(hintPerkawinan)
        formPendidikan(hintPendidikan)
        formJenisKelamin(hintJenisKelamin)
        setDatePicker()
        phoneNumberWatcher()
        noBPJSWatcherr()

        pref = requireActivity().getSharedPreferences("login_pref", Context.MODE_PRIVATE)

        binding.btnSimpanData.setOnClickListener {

            val nik = arguments?.getString("nik")
            val pass = arguments?.getString("pass")

            val nama = binding.edtNama.text.toString()
            pekerjaan = binding.edtPekerjaan.text.toString()
            val noBpjs = binding.edtBpjs.text.toString()
            val noHp = "0"+ binding.edtNoTelepon.text.toString()

            Log.d("Second Register Fragment" , "$nik $pass")

            registerViewModel.registerPasien(nik!!,nama,jenisKelamin,tanggalLahir,agama,pekerjaan,pendidikan,perkawinan,noBpjs,noHp, pass!!)
            registerViewModel.registerResult.observe(requireActivity(), androidx.lifecycle.Observer {

                when(it.status){

                    Status.SUCCESS -> {
                        loading.dismissDialog()
                        val registerResponse = it.data
                        if (registerResponse!=null){
                            stateViewModel.saveLoginState(true)
                            stateViewModel.saveToken(registerResponse.token)
                            //get new token
                            val editor = pref.edit()
                            editor.putString("key_token",registerResponse.token)
                            editor.apply()
                            Log.d("Register Fragment", "Register Success")
                            val intent = Intent(requireContext(),DashboardActivity::class.java)
                            startActivity(intent)
                        }
                    }
                    Status.LOADING->{
                        loading.startLoading()
                        Log.d("Register Fragment", "Progress Loading")
                    }
                    Status.ERROR ->{
                        loading.dismissDialog()
                        Log.d("Register Fragment", "${it.data}, ${it.message}")
                        AlertDialog.Builder(requireContext()).apply {
                            val jsonObject = JSONTokener(it.message).nextValue() as JSONObject
                            val mssg = jsonObject.getString("message")
                            setMessage(mssg)
                            create()
                            show()
                        }
                    }

                }

            })
        }

    }

    private fun phoneNumberWatcher() {
        binding.edtNoTelepon.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                //
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {

            }

            override fun afterTextChanged(p0: Editable?) {
                utils.checkPhoneNum(binding.tvErrorPhoneNum, p0)

            }
        })
    }

    private fun noBPJSWatcherr() {
        binding.edtBpjs.addTextChangedListener(object : TextWatcher {

            private var mFormatting = false
            private var mDelete = false
            private var mLastLength = 0

            override fun beforeTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {
                mLastLength = p0?.length ?: 0
            }

            override fun onTextChanged(p0: CharSequence?, p1: Int, p2: Int, p3: Int) {

            }

            override fun afterTextChanged(p0: Editable?) {

                if (mFormatting) {
                    return
                }

                var length = p0?.length ?: 0

                if (length < mLastLength) {
                    mDelete = true
                }

                if (length == 4 || length == 9) {
                    if (!mDelete) {
                        p0?.append('.')
                        length++
                    }
                }

                mFormatting = true
                mLastLength = length
                mDelete = false

//                binding.tvCounter.visibility = View.VISIBLE
//                utils.checkBPJS(binding.tvErrorBpjs, p0)
//                utils.counterText(binding.tvCounter, "/11", p0)
            }
        })
    }

    private fun formJenisKelamin(hintJenisKelamin:Array<String>) {
        binding.edtJenisKelamin.apply {
            val adapterJenisKelamin = ArrayAdapter(requireContext(), R.layout.dropdown_item, hintJenisKelamin)
            setAdapter(adapterJenisKelamin)
            setHint(context.getString(R.string.str_jenis_kelamin))
            onItemClickListener = AdapterView.OnItemClickListener{
                    _, _, position, _ ->
                utils.makeToast(requireContext(), hintJenisKelamin[position])
                jenisKelamin = adapterJenisKelamin.getItem(position).toString()
                setupKeyboard(binding.edtJenisKelamin)
            }
        }
    }

    private fun setupKeyboard(view: View) {
        keyboardUtils.hideKeyboard( FragmentComponentManager.findActivity(view.context) as Activity, view)
    }

    private fun setDatePicker() {
        binding.edtTanggalLahir.setOnClickListener{
            val calendar = Calendar.getInstance()

            val year = calendar.get(Calendar.YEAR)
            val month = calendar.get(Calendar.MONTH)
            val day = calendar.get(Calendar.DAY_OF_MONTH)

            val datePickerDialog = DatePickerDialog(requireContext(),
                { _, year, month, dayOfMonth ->
//                    tanggalLahir = "$dayOfMonth/${month + 1}/$year"
                    tanggalLahir = "$year-$month-$dayOfMonth"
                    binding.edtTanggalLahir.setText(tanggalLahir)
                },
                year, month, day,
            )
            datePickerDialog.show()
            setupKeyboard(binding.edtTanggalLahir)

        }
    }

    private fun formPendidikan(hintPendidikan: Array<String>) {
        binding.edtPendidikan.apply {
            val adapterPendidikan = ArrayAdapter(requireContext(),R.layout.dropdown_item,hintPendidikan)
            setAdapter(adapterPendidikan)
            hint = "Pilih Pendidikan"
            onItemClickListener = AdapterView.OnItemClickListener{
                    _, _, position, _ ->
                utils.makeToast(requireContext(), hintPendidikan[position])
                pendidikan = adapterPendidikan.getItem(position).toString()
                setupKeyboard(binding.edtPendidikan)
            }
        }
    }

    private fun formPerkawinan(hintPerkawinan: Array<String>) {
        binding.edtPerkawinan.apply {
            val adapterPerkawinan = ArrayAdapter(requireContext(),R.layout.dropdown_item,hintPerkawinan)
            setAdapter(adapterPerkawinan)
            hint = "Pilih Status Perkawinan"
            onItemClickListener = AdapterView.OnItemClickListener { _, _, position, _ ->
                utils.makeToast(requireContext(), hintPerkawinan[position])
                perkawinan = adapterPerkawinan.getItem(position).toString()
                setupKeyboard(binding.edtPerkawinan)
            }
        }
    }

    private fun formAgama(hintAgama: Array<String>) {
        binding.edtAgama.apply {
            val adapterAgama = ArrayAdapter(requireContext(), R.layout.dropdown_item, hintAgama)
            setAdapter(adapterAgama)
            hint = "Pilih Agama"
            onItemClickListener = AdapterView.OnItemClickListener { _, _, position, _ ->
                utils.makeToast(requireContext(), hintAgama[position])
                agama = adapterAgama.getItem(position).toString()
                setupKeyboard(binding.edtPerkawinan)
            }
        }
    }


    private fun formPekerjaan(hintPekerjaan: Array<String>) {

        binding.edtPekerjaan.apply {
            val adapterPekerjaan = ArrayAdapter(requireContext(), R.layout.dropdown_item, hintPekerjaan)
            setAdapter(adapterPekerjaan)
        }
    }


}