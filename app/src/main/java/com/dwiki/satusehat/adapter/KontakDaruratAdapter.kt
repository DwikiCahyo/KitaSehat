package com.dwiki.satusehat.adapter

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.model.responseModel.KontakDaruratResponse
import com.dwiki.satusehat.model.responseModel.ListKontakDaruratItem
import com.dwiki.satusehat.databinding.ItemKontakDaruratBinding

class KontakDaruratAdapter(
    private var listKontak:List<ListKontakDaruratItem>,
    private val onSelect: (ListKontakDaruratItem) -> Unit
    ):RecyclerView.Adapter<KontakDaruratAdapter.ViewHolder>() {

    class ViewHolder(private val binding:ItemKontakDaruratBinding):RecyclerView.ViewHolder(binding.root) {
        fun bind(kontak: ListKontakDaruratItem, onSelect: (ListKontakDaruratItem) -> Unit){
            binding.apply {
                tvNamaKontak.text = kontak.nama
                tvNoTelepon.text = kontak.noHp
                btnTelepon.setOnClickListener {
                    onSelect(kontak)
                }

            }
        }
    }

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): KontakDaruratAdapter.ViewHolder {
        val view = ItemKontakDaruratBinding.inflate(LayoutInflater.from(parent.context),parent,false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: KontakDaruratAdapter.ViewHolder, position: Int) {
        holder.bind(listKontak[position],onSelect)
    }

    override fun getItemCount(): Int = listKontak.size
}