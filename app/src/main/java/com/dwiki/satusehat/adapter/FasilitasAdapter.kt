package com.dwiki.satusehat.adapter

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.data.responseModel.FasilitasRumahSakitItem
import com.dwiki.satusehat.databinding.ItemFasilitasRsBinding

class FasilitasAdapter(private var fasilitasRs:List<FasilitasRumahSakitItem>):RecyclerView.Adapter<FasilitasAdapter.ViewHolder>() {

    class ViewHolder (val binding:ItemFasilitasRsBinding):RecyclerView.ViewHolder(binding.root) {}

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): FasilitasAdapter.ViewHolder {
       val view = ItemFasilitasRsBinding.inflate(LayoutInflater.from(parent.context),parent,false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: FasilitasAdapter.ViewHolder, position: Int) {
        holder.binding.tvNamaFasilitas.text = fasilitasRs[position].fasilitas.namaLayanan
    }

    override fun getItemCount(): Int  = fasilitasRs.size
}