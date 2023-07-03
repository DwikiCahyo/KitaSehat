package com.dwiki.satusehat.adapter

import android.annotation.SuppressLint
import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.model.responseModel.ListRumahSakitItem
import com.dwiki.satusehat.databinding.ItemRumahSakitMapBinding
import java.util.Collections.addAll

class RumahSakitMapAdapter(private var listRumahSakit:List<ListRumahSakitItem>):RecyclerView.Adapter<RumahSakitMapAdapter.ViewHolder>() {

    private var onItemClickCallback: OnItemClickCallback? = null
    private var  onLocationClickCallback:OnMapClickCallback? = null

    fun setOnItemClickCallback(onItemClickCallback: OnItemClickCallback) {
        this.onItemClickCallback = onItemClickCallback
    }

    fun setOnLocationClickCallBack(onLocationClickCallback: OnMapClickCallback) {
        this.onLocationClickCallback = onLocationClickCallback
    }

    fun getItem(item:List<ListRumahSakitItem>){
        this.listRumahSakit = item
    }

    inner class ViewHolder(val binding:ItemRumahSakitMapBinding):RecyclerView.ViewHolder(binding.root) {
        fun bind(listRumahSakit: ListRumahSakitItem){

            binding.apply {
                tvNamaRs.text = listRumahSakit.nama
                tvLokasiRs.text = listRumahSakit.daerah.namaDaerah
            }
            binding.btnLokasi.setOnClickListener {
                onLocationClickCallback?.onMapClicked(listRumahSakit)
            }
            binding.btnDetail.setOnClickListener {
                onItemClickCallback?.onItemClicked(listRumahSakit)
            }

        }

    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val binding = ItemRumahSakitMapBinding.inflate(LayoutInflater.from(parent.context),parent,false)
        return ViewHolder(binding)
    }

    override fun getItemCount(): Int  = listRumahSakit.size

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        holder.bind(listRumahSakit[position])
    }

    interface OnItemClickCallback {
        fun onItemClicked(listRumahSakit: ListRumahSakitItem)
    }

    interface OnMapClickCallback{
        fun onMapClicked(listRumahSakit: ListRumahSakitItem)
    }
}