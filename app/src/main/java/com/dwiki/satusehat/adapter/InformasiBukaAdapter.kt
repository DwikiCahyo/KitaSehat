package com.dwiki.satusehat.adapter

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.model.responseModel.DataFasilitasRumahSakitItem
import com.dwiki.satusehat.databinding.ItemJamBukaBinding

class InformasiBukaAdapter(private val listInformasi:List<DataFasilitasRumahSakitItem>):RecyclerView.Adapter<InformasiBukaAdapter.ViewHolder>() {

    class ViewHolder(private val binding:ItemJamBukaBinding):RecyclerView.ViewHolder(binding.root) {
        fun bind(dataFasilitasRumahSakitItem: DataFasilitasRumahSakitItem){
            binding.apply {
                tvFasilitasNama.text = dataFasilitasRumahSakitItem.fasilitasNamaLayanan
                if (dataFasilitasRumahSakitItem.jamBuka != null){
                    tvJamBuka.text = dataFasilitasRumahSakitItem.jamBuka.toString()
                }else{
                    tvJamBuka.text = "Belum Ada jam buka"
                }
                if (dataFasilitasRumahSakitItem.hariBuka != null){
                    tvHariBuka.text = dataFasilitasRumahSakitItem.hariBuka.toString()
                }else{
                    tvHariBuka.text = "Belum Ada hari buka"
                }
            }
        }
    }

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): InformasiBukaAdapter.ViewHolder {
        val binding = ItemJamBukaBinding.inflate(LayoutInflater.from(parent.context),parent,false)
        return ViewHolder(binding)
    }

    override fun onBindViewHolder(holder: InformasiBukaAdapter.ViewHolder, position: Int) {
        holder.bind(listInformasi[position])
    }

    override fun getItemCount(): Int = listInformasi.size
}